<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Utils\GetTokensAsString;

/**
 * Detects using the same variable for both the key as well as the value in a foreach assignment.
 *
 * @link https://twitter.com/exakat/status/1509103728934203397
 * @link https://3v4l.org/DdddX
 *
 * @since 1.0.0
 */
final class ForeachUniqueAssignmentSniff implements Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function register()
    {
        return [\T_FOREACH];
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

        if (isset($tokens[$stackPtr]['parenthesis_opener'], $tokens[$stackPtr]['parenthesis_closer']) === false) {
            // Parse error or live coding, not our concern.
            return;
        }

        $opener = $tokens[$stackPtr]['parenthesis_opener'];
        $closer = $tokens[$stackPtr]['parenthesis_closer'];

        $asPtr = $phpcsFile->findNext(\T_AS, ($opener + 1), $closer);
        if ($asPtr === false) {
            // Parse error or live coding, not our concern.
            return;
        }

        $doubleArrowPtr = $phpcsFile->findNext(\T_DOUBLE_ARROW, ($asPtr + 1), $closer);
        if ($doubleArrowPtr === false) {
            // Key does not get assigned.
            return;
        }

        $keyAsString   = GetTokensAsString::noEmpties($phpcsFile, ($asPtr + 1), ($doubleArrowPtr - 1));
        $valueAsString = GetTokensAsString::noEmpties($phpcsFile, ($doubleArrowPtr + 1), ($closer - 1));

        if (\ltrim($keyAsString, '&') !== \ltrim($valueAsString, '&')) {
            // Key and value not the same.
            return;
        }

        $error  = 'The variables used for the key and the value in a foreach assignment should be unique.';
        $error .= 'Both the key and the value will be currently assigned to: "%s"';

        $fix = $phpcsFile->addFixableError($error, $doubleArrowPtr, 'NotUnique', [$valueAsString]);
        if ($fix === true) {
            $phpcsFile->fixer->beginChangeset();

            // Remove the key.
            for ($i = ($asPtr + 1); $i < ($doubleArrowPtr + 1); $i++) {
                if ($tokens[$i]['code'] === \T_WHITESPACE
                    && isset(Tokens::$commentTokens[$tokens[($i + 1)]['code']])
                ) {
                    // Don't remove whitespace when followed directly by a comment.
                    continue;
                }

                if (isset(Tokens::$commentTokens[$tokens[$i]['code']])) {
                    // Don't remove comments.
                    continue;
                }

                // Remove everything else.
                $phpcsFile->fixer->replaceToken($i, '');
            }

            $phpcsFile->fixer->endChangeset();
        }
    }
}
