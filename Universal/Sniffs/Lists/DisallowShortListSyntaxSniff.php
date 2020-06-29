<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\Lists;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHPCSUtils\Utils\Lists;

/**
 * Bans the use of the PHP short list syntax.
 *
 * @since 1.0.0
 */
class DisallowShortListSyntaxSniff implements Sniff
{

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @since 1.0.0
     *
     * @return int[]
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
        $tokens    = $phpcsFile->getTokens();
        $openClose = Lists::getOpenClose($phpcsFile, $stackPtr);

        if ($openClose === false) {
            // Not a short list, live coding or parse error.
            if (isset($tokens[$stackPtr]['bracket_closer']) === true) {
                // No need to examine nested subs of this short array/array access.
                return $tokens[$stackPtr]['bracket_closer'];
            }

            return;
        }

        $phpcsFile->recordMetric($stackPtr, 'Short list syntax used', 'yes');

        $fix = $phpcsFile->addFixableError('Short list syntax is not allowed', $stackPtr, 'Found');

        if ($fix === true) {
            $opener = $openClose['opener'];
            $closer = $openClose['closer'];

            $phpcsFile->fixer->beginChangeset();
            $phpcsFile->fixer->replaceToken($opener, 'list(');
            $phpcsFile->fixer->replaceToken($closer, ')');
            $phpcsFile->fixer->endChangeset();
        }
    }
}
