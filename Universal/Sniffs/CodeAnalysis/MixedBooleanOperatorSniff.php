<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2021 WoltLab GmbH, 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHPCSUtils\BackCompat\BCFile;

/**
 * Forbid mixing `&&` and `||` within a single expression without making precedence
 * clear using parentheses.
 *
 * @link https://github.com/squizlabs/PHP_CodeSniffer/pull/3205
 * @link https://github.com/php-fig/per-coding-style/issues/22
 *
 * @since 1.2.0
 */
final class MixedBooleanOperatorSniff implements Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.2.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [
            \T_BOOLEAN_OR,
            \T_BOOLEAN_AND,
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 1.2.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $token  = $tokens[$stackPtr];

        $start = BCFile::findStartOfStatement($phpcsFile, $stackPtr);

        if ($token['code'] === \T_BOOLEAN_AND) {
            $search = \T_BOOLEAN_OR;
        } elseif ($token['code'] === \T_BOOLEAN_OR) {
            $search = \T_BOOLEAN_AND;
        } else {
            throw new \LogicException('Unreachable');
        }

        while (true) {
            $previous = $phpcsFile->findPrevious(
                [
                    $search,
                    \T_OPEN_PARENTHESIS,
                    \T_OPEN_SQUARE_BRACKET,
                    \T_OPEN_CURLY_BRACKET,
                    \T_CLOSE_PARENTHESIS,
                    \T_CLOSE_SQUARE_BRACKET,
                    \T_CLOSE_CURLY_BRACKET,
                ],
                $stackPtr,
                $start
            );

            if ($previous === false) {
                break;
            }

            if ($tokens[$previous]['code'] === \T_OPEN_PARENTHESIS
                || $tokens[$previous]['code'] === \T_OPEN_SQUARE_BRACKET
                || $tokens[$previous]['code'] === \T_OPEN_CURLY_BRACKET
            ) {
                // We halt if we reach the opening parens / bracket of the boolean operator.
                return;
            } elseif ($tokens[$previous]['code'] === \T_CLOSE_PARENTHESIS) {
                // We skip the content of nested parens.
                $stackPtr = ($tokens[$previous]['parenthesis_opener'] - 1);
            } elseif ($tokens[$previous]['code'] === \T_CLOSE_SQUARE_BRACKET) {
                // We skip the content of nested square brackets.
                $stackPtr = ($tokens[$previous]['bracket_opener'] - 1);
            } elseif ($tokens[$previous]['code'] === \T_CLOSE_CURLY_BRACKET) {
                // We skip the content of nested curly brackets.
                $stackPtr = ($tokens[$previous]['bracket_opener'] - 1);
            } elseif ($tokens[$previous]['code'] === $search) {
                // We reached a mismatching operator, thus we must report the error.
                $error = "Mixing '&&' and '||' within an expression without using parentheses to clarify precedence.";
                $phpcsFile->addError($error, $stackPtr, 'MissingParentheses', []);
                return;
            } else {
                throw new \LogicException('Unreachable');
            }
        }
    }
}
