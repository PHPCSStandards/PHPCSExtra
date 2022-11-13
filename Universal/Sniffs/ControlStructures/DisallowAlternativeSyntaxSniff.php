<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Tokens\Collections;
use PHPCSUtils\Utils\ControlStructures;

/**
 * Forbid the use of the alternative syntax for control structures.
 *
 * @since 1.0.0
 */
final class DisallowAlternativeSyntaxSniff implements Sniff
{

    /**
     * Name of the metric.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const METRIC_NAME = 'Control Structure Style';

    /**
     * Whether to allow the alternative syntax when it is wrapped around
     * inline HTML, as is often seen in views.
     *
     * Note: inline HTML within "closed scopes" - like function declarations -,
     * within the control structure body will not be taken into account.
     *
     * @since 1.0.0
     *
     * @var bool
     */
    public $allowWithInlineHTML = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function register()
    {
        return Collections::alternativeControlStructureSyntaxes();
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

        /*
         * Deal with `else if`.
         */
        if ($tokens[$stackPtr]['code'] === \T_ELSE
            && isset($tokens[$stackPtr]['scope_opener']) === false
            && ControlStructures::isElseIf($phpcsFile, $stackPtr) === true
        ) {
            // This is an `else if` - this will be dealt with on the `if` token.
            return;
        }

        /*
         * Ignore control structures without body (i.e. single line control structures).
         * This doesn't ignore _empty_ bodies.
         */
        if (ControlStructures::hasBody($phpcsFile, $stackPtr, true) === false) {
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'single line (without body)');
            return;
        }

        /*
         * Check if the control structure uses alternative syntax.
         */
        if (isset($tokens[$stackPtr]['scope_opener'], $tokens[$stackPtr]['scope_closer']) === false) {
            // No scope opener found: inline control structure or parse error.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'inline');
            return;
        }

        $opener = $tokens[$stackPtr]['scope_opener'];
        $closer = $tokens[$stackPtr]['scope_closer'];

        if ($tokens[$opener]['code'] !== \T_COLON) {
            // Curly brace syntax (not our concern).
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'curly braces');
            return;
        }

        $closedScopes         = Collections::closedScopes();
        $find                 = $closedScopes;
        $find[\T_INLINE_HTML] = \T_INLINE_HTML;
        $inlineHTMLPtr        = $opener;
        $hasInlineHTML        = false;

        do {
            $inlineHTMLPtr = $phpcsFile->findNext($find, ($inlineHTMLPtr + 1), $closer);
            if ($tokens[$inlineHTMLPtr]['code'] === \T_INLINE_HTML) {
                $hasInlineHTML = true;
                break;
            }

            if (isset($closedScopes[$tokens[$inlineHTMLPtr]['code']], $tokens[$inlineHTMLPtr]['scope_closer'])) {
                $inlineHTMLPtr = $tokens[$inlineHTMLPtr]['scope_closer'];
            }
        } while ($inlineHTMLPtr !== false && $inlineHTMLPtr < $closer);

        if ($hasInlineHTML === true) {
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'alternative syntax with inline HTML');
        } else {
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'alternative syntax');
        }

        if ($hasInlineHTML === true && $this->allowWithInlineHTML === true) {
            return;
        }

        $error = 'Using control structures with the alternative syntax is not allowed';
        if ($this->allowWithInlineHTML === true) {
            $error .= ' unless the control structure contains inline HTML';
        }
        $error .= '. Found: %1$s(): ... end%1$s;';

        $code = 'Found' . \ucfirst($tokens[$stackPtr]['content']);
        if ($hasInlineHTML === true) {
            $code .= 'WithInlineHTML';
        }

        $data = [$tokens[$stackPtr]['content']];
        if ($tokens[$stackPtr]['code'] === \T_ELSEIF || $tokens[$stackPtr]['code'] === \T_ELSE) {
            $data = ['if'];
        }

        $fix = $phpcsFile->addFixableError($error, $tokens[$stackPtr]['scope_opener'], $code, $data);
        if ($fix === false) {
            return;
        }

        /*
         * Fix it.
         */
        $phpcsFile->fixer->beginChangeset();
        $phpcsFile->fixer->replaceToken($opener, '{');

        if (isset(Collections::alternativeControlStructureSyntaxClosers()[$tokens[$closer]['code']]) === true) {
            $phpcsFile->fixer->replaceToken($closer, '}');

            $semicolon = $phpcsFile->findNext(Tokens::$emptyTokens, ($closer + 1), null, true);
            if ($semicolon !== false && $tokens[$semicolon]['code'] === \T_SEMICOLON) {
                $phpcsFile->fixer->replaceToken($semicolon, '');
            }
        } else {
            // This must be an if/else using alternative syntax. The closer will be the next control structure keyword.
            $phpcsFile->fixer->addContentBefore($closer, '} ');
        }

        $phpcsFile->fixer->endChangeset();
    }
}
