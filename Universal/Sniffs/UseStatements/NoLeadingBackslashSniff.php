<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\UseStatements;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Utils\UseStatements;

/**
 * Verifies that names being imported in import use statements do not start with a leading backslash.
 *
 * This sniff handles all types of import use statements supported by PHP, in contrast to any
 * of the other sniffs for the same in, for instance, the PSR12 or the Slevomat standard,
 * all of which are incomplete.
 *
 * @since 1.0.0
 */
class NoLeadingBackslashSniff implements Sniff
{

    /**
     * Name of the metric.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const METRIC_NAME = 'Import use with leading backslash';

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function register()
    {
        return [\T_USE];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 1.0.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        if (UseStatements::isImportUse($phpcsFile, $stackPtr) === false) {
            // Trait or closure use statement.
            return;
        }

        $endOfStatement = $phpcsFile->findNext([\T_SEMICOLON, \T_CLOSE_TAG, \T_OPEN_USE_GROUP], ($stackPtr + 1));
        if ($endOfStatement === false) {
            // Live coding or parse error.
            return;
        }

        $tokens  = $phpcsFile->getTokens();
        $current = $stackPtr;

        do {
            $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($current + 1), $endOfStatement, true);
            if ($nextNonEmpty === false) {
                // Reached the end of the statement.
                return;
            }

            // Skip past 'function'/'const' keyword.
            $contentLC = \strtolower($tokens[$nextNonEmpty]['content']);
            if ($tokens[$nextNonEmpty]['code'] === \T_STRING
                && ($contentLC === 'function' || $contentLC === 'const')
            ) {
                $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($nextNonEmpty + 1), $endOfStatement, true);
                if ($nextNonEmpty === false) {
                    // Reached the end of the statement.
                    return;
                }
            }

            if ($tokens[$nextNonEmpty]['code'] === \T_NS_SEPARATOR) {
                $phpcsFile->recordMetric($nextNonEmpty, self::METRIC_NAME, 'yes');

                $error = 'An import use statement should never start with a leading backslash';
                $fix   = $phpcsFile->addFixableError($error, $nextNonEmpty, 'LeadingBackslashFound');

                if ($fix === true) {
                    if ($tokens[$nextNonEmpty - 1]['code'] !== \T_WHITESPACE) {
                        $phpcsFile->fixer->replaceToken($nextNonEmpty, ' ');
                    } else {
                        $phpcsFile->fixer->replaceToken($nextNonEmpty, '');
                    }
                }
            } else {
                $phpcsFile->recordMetric($nextNonEmpty, self::METRIC_NAME, 'no');
            }

            // Move the stackPtr forward to the next part of the use statement, if any.
            $current = $phpcsFile->findNext(\T_COMMA, ($current + 1), $endOfStatement);
        } while ($current !== false);
    }
}
