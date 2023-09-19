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
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\BackCompat\BCFile;

/**
 * Forbid mixing different binary boolean operators within a single expression without making precedence
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
        return Tokens::$booleanOperators;
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

        $valid = $token['code'];

        $previous = $phpcsFile->findPrevious(
            \array_merge(
                $this->register(),
                [\T_INLINE_THEN, \T_INLINE_ELSE]
            ),
            $stackPtr - 1,
            $start,
            false,
            null,
            true
        );

        if (
            $previous === false
            || $tokens[$previous]['code'] === $valid
            || \in_array($tokens[$previous]['code'], [\T_INLINE_THEN, \T_INLINE_ELSE], true)
        ) {
            return;
        }

        // We found a mismatching operator, thus we must report the error.
        $error = "Mixing different binary boolean operators within an expression without using parentheses to clarify precedence.";
        $phpcsFile->addError($error, $stackPtr, 'MissingParentheses', []);
    }
}
