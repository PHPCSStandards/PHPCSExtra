<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\Constants;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Verifies that the "::class" keyword when used for class name resolution is in lowercase.
 *
 * @link https://www.php.net/manual/en/language.constants.predefined.php
 * @link https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.class.class
 *
 * @since 1.0.0
 */
class LowercaseClassResolutionKeywordSniff implements Sniff
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
        /*
         * In PHPCS < 3.4.1, the class keyword after a double colon + comment may be tokenized as
         * `T_CLASS` instead of as `T_STRING`, so registering both.
         *
         * @link https://github.com/squizlabs/php_codesniffer/issues/2431
         */
        return [
            \T_STRING,
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
        $tokens    = $phpcsFile->getTokens();
        $content   = $tokens[$stackPtr]['content'];
        $contentLC = \strtolower($content);

        if ($contentLC !== 'class') {
            return;
        }

        $prevToken = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if ($prevToken === false || $tokens[$prevToken]['code'] !== \T_DOUBLE_COLON) {
            return;
        }

        if ($contentLC === $content) {
            $phpcsFile->recordMetric($stackPtr, 'Magic ::class constant case', 'lowercase');
            return;
        }

        $error = "The ::class keyword for class name resolution must be in lowercase. Expected: '::%s'; found: '::%s'";
        $data  = [
            $contentLC,
            $content,
        ];

        $errorCode = '';
        if (\strtoupper($content) === $content) {
            $errorCode = 'Uppercase';
            $phpcsFile->recordMetric($stackPtr, 'Magic ::class constant case', 'uppercase');
        } else {
            $errorCode = 'Mixedcase';
            $phpcsFile->recordMetric($stackPtr, 'Magic ::class constant case', 'mixed case');
        }

        $fix = $phpcsFile->addFixableError($error, $stackPtr, $errorCode, $data);
        if ($fix === true) {
            $phpcsFile->fixer->replaceToken($stackPtr, $contentLC);
        }
    }
}
