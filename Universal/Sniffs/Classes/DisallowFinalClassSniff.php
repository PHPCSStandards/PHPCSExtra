<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHPCSUtils\BackCompat\BCFile;
use PHPCSUtils\Utils\GetTokensAsString;

/**
 * Forbids classes from being declared as "final".
 *
 * @since 1.0.0
 */
final class DisallowFinalClassSniff implements Sniff
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
        return [
            \T_CLASS,
        ];
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
        /*
         * Deliberately using the BCFile version of getClassProperties to allow
         * for handling the parse error of classes declared as both final + abstract.
         */
        $classProp = BCFile::getClassProperties($phpcsFile, $stackPtr);
        if ($classProp['is_final'] === false) {
            if ($classProp['is_abstract'] === true) {
                $phpcsFile->recordMetric($stackPtr, 'Class declaration type', 'abstract');
            }

            $phpcsFile->recordMetric($stackPtr, 'Class declaration type', 'not abstract, not final');
            return;
        }

        $tokens = $phpcsFile->getTokens();
        if (isset($tokens[$stackPtr]['scope_opener']) === false) {
            // Live coding or parse error.
            return;
        }

        $phpcsFile->recordMetric($stackPtr, 'Class declaration type', 'final');

        // No extra safeguards needed, we know the keyword will exist based on the check above.
        $finalKeyword = $phpcsFile->findPrevious(\T_FINAL, ($stackPtr - 1));

        $snippet = GetTokensAsString::compact($phpcsFile, $finalKeyword, $tokens[$stackPtr]['scope_opener'], true);
        $fix     = $phpcsFile->addFixableError(
            'Declaring a class as final is not allowed. Found: %s}',
            $finalKeyword,
            'FinalClassFound',
            [$snippet]
        );

        if ($fix === true) {
            $phpcsFile->fixer->beginChangeset();
            $phpcsFile->fixer->replaceToken($finalKeyword, '');

            // Remove redundant whitespace.
            for ($i = ($finalKeyword + 1); $i < $stackPtr; $i++) {
                if ($tokens[$i]['code'] === \T_WHITESPACE) {
                    $phpcsFile->fixer->replaceToken($i, '');
                    continue;
                }

                break;
            }

            $phpcsFile->fixer->endChangeset();
        }
    }
}
