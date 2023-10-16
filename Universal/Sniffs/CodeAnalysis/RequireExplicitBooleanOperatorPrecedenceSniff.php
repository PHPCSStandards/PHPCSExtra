<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
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
 * The unary `!` operator is not handled, because its high precedence matches its visuals of
 * applying only to the sub-expression right next to it, making it unlikely that someone would
 * misinterpret its precedence. Requiring parentheses around it would reduce the readability of
 * expressions due to the additional characters, especially if multiple subexpressions / variables
 * need to be negated.
 *
 * Sister-sniff to the PHPCS native `Squiz.ControlStructures.InlineIfDeclaration` and
 * `Squiz.Formatting.OperatorBracket.MissingBrackets` sniffs.
 *
 * @link https://github.com/squizlabs/PHP_CodeSniffer/pull/3205
 * @link https://github.com/php-fig/per-coding-style/issues/22
 *
 * @since 1.2.0
 */
final class RequireExplicitBooleanOperatorPrecedenceSniff implements Sniff
{

    /**
     * Array of tokens this test searches for to find either a boolean
     * operator or the start of the current (sub-)expression. Used for
     * performance optimization purposes.
     *
     * @since 1.2.0
     *
     * @var array<int|string>
     */
    private $searchTargets = [];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.2.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        $this->searchTargets                 = Tokens::$booleanOperators;
        $this->searchTargets                += Tokens::$blockOpeners;
        $this->searchTargets[\T_INLINE_THEN] = \T_INLINE_THEN;
        $this->searchTargets[\T_INLINE_ELSE] = \T_INLINE_ELSE;

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

        $start = BCFile::findStartOfStatement($phpcsFile, $stackPtr);

        $previous = $phpcsFile->findPrevious(
            $this->searchTargets,
            $stackPtr - 1,
            $start,
            false,
            null,
            true
        );

        if (
            // No token found.
            $previous === false
            // Identical operator found.
            || $tokens[$previous]['code'] === $tokens[$stackPtr]['code']
            // Beginning of the expression found for the ternary conditional operator.
            || \in_array($tokens[$previous]['code'], [\T_INLINE_THEN, \T_INLINE_ELSE], true)
            // Beginning of the expression found for a block opener. Needed to
            // correctly handle match arms.
            || isset(Tokens::$blockOpeners[$tokens[$previous]['code']])
        ) {
            return;
        }

        // We found a mismatching operator, thus we must report the error.
        $error  = 'Mixing different binary boolean operators within an expression';
        $error .= ' without using parentheses to clarify precedence is not allowed.';
        $phpcsFile->addError($error, $stackPtr, 'MissingParentheses');
    }
}
