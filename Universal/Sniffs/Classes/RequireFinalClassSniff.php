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
use PHPCSUtils\Utils\GetTokensAsString;
use PHPCSUtils\Utils\ObjectDeclarations;

/**
 * Require classes being declared as "final".
 *
 * @since 1.0.0
 */
class RequireFinalClassSniff implements Sniff
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
        $classProp = ObjectDeclarations::getClassProperties($phpcsFile, $stackPtr);
        if ($classProp['is_final'] === true) {
            $phpcsFile->recordMetric($stackPtr, 'Class declaration type', 'final');
            return;
        }

        if ($classProp['is_abstract'] === true) {
            // Abstract classes can't be final.
            $phpcsFile->recordMetric($stackPtr, 'Class declaration type', 'abstract');
            return;
        }

        $tokens = $phpcsFile->getTokens();
        if (isset($tokens[$stackPtr]['scope_opener']) === false) {
            // Live coding or parse error.
            return;
        }

        $phpcsFile->recordMetric($stackPtr, 'Class declaration type', 'not abstract, not final');

        $snippet = GetTokensAsString::compact($phpcsFile, $stackPtr, $tokens[$stackPtr]['scope_opener'], true);
        $fix     = $phpcsFile->addFixableError(
            'A non-abstract class should be declared as final. Found: %s}',
            $stackPtr,
            'NonFinalClassFound',
            [$snippet]
        );

        if ($fix === true) {
            $phpcsFile->fixer->addContentBefore($stackPtr, 'final ');
        }
    }
}
