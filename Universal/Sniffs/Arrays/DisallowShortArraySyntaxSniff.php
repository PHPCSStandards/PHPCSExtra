<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\Arrays;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHPCSUtils\Utils\Arrays;

/**
 * Disallow the use of the short array syntax.
 *
 * Improved version of the upstream `Generic.Arrays.DisallowShortArraySyntax` sniff which does
 * not account for short lists and because of this can cause parse errors when auto-fixing.
 *
 * Other related sniffs:
 * - `Generic.Arrays.DisallowLongArraySyntax` Forbids the use of the long array syntax.
 *
 * @since 1.0.0 This sniff is loosely based on and inspired by the upstream
 *              `Generic.Arrays.DisallowShortArraySyntax` sniff.
 */
class DisallowShortArraySyntaxSniff implements Sniff
{

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @since 1.0.0
     *
     * @return int|string[]
     */
    public function register()
    {
        return [\T_OPEN_SHORT_ARRAY];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 1.0.0
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

        if (Arrays::isShortArray($phpcsFile, $stackPtr) === false) {
            // No need to examine nested subs of this short list.
            return $tokens[$stackPtr]['bracket_closer'];
        }

        $error = 'Short array syntax is not allowed';
        $fix   = $phpcsFile->addFixableError($error, $stackPtr, 'Found');

        if ($fix === true) {
            $phpcsFile->fixer->beginChangeset();
            $phpcsFile->fixer->replaceToken($tokens[$stackPtr]['bracket_opener'], 'array(');
            $phpcsFile->fixer->replaceToken($tokens[$stackPtr]['bracket_closer'], ')');
            $phpcsFile->fixer->endChangeset();
        }
    }
}
