<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Forbids the use of `true`/`false`/`null` as fully qualified constants.
 *
 * @since 1.3.0
 */
final class NoFQNTrueFalseNullSniff implements Sniff
{

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @since 1.3.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [
            // PHP < 8.0.
            \T_TRUE,
            \T_FALSE,
            \T_NULL,

            // PHP >= 8.0.
            \T_STRING,
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 1.3.0
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

        if ($contentLC !== 'true' && $contentLC !== 'false' && $contentLC !== 'null') {
            return;
        }

        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if ($tokens[$prev]['code'] !== \T_NS_SEPARATOR) {
            return;
        }

        $prevPrev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($prev - 1), null, true);
        if ($tokens[$prevPrev]['code'] === \T_STRING || $tokens[$prevPrev]['code'] === \T_NAMESPACE) {
            return;
        }

        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($tokens[$next]['code'] === \T_NS_SEPARATOR) {
            return;
        }

        $fix = $phpcsFile->addFixableError(
            'The special PHP constant "%s" should not be fully qualified.',
            $prev,
            'Found',
            [$contentLC]
        );

        if ($fix === true) {
            $phpcsFile->fixer->replaceToken($prev, '');
        }
    }
}
