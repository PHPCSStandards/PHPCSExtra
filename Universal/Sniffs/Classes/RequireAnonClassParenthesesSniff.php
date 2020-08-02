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
use PHP_CodeSniffer\Util\Tokens;

/**
 * Require that an anonymous class declaration/instantiation has parentheses, i.e. `new class().
 *
 * @since 1.0.0
 */
class RequireAnonClassParenthesesSniff implements Sniff
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
            \T_ANON_CLASS,
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
        $tokens = $phpcsFile->getTokens();

        $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($nextNonEmpty !== false
            && $tokens[$nextNonEmpty]['code'] === \T_OPEN_PARENTHESIS
        ) {
            // Parentheses found.
            $phpcsFile->recordMetric($stackPtr, 'Anon class declaration with parenthesis', 'yes');
            return;
        }

        $phpcsFile->recordMetric($stackPtr, 'Anon class declaration with parenthesis', 'no');

        $fix = $phpcsFile->addFixableError(
            'Parenthesis required when creating a new anonymous class.',
            $stackPtr,
            'Missing'
        );

        if ($fix === true) {
            $phpcsFile->fixer->addContent($stackPtr, '()');
        }
    }
}
