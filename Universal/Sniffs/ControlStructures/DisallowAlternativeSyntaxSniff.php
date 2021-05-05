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
class DisallowAlternativeSyntaxSniff implements Sniff
{

    /**
     * Whether to allow the alternative syntax when it is wrapped around
     * inline HTML, as is often seen in views.
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
        return [
            \T_IF,
            \T_ELSE,
            \T_ELSEIF,
            \T_FOR,
            \T_FOREACH,
            \T_SWITCH,
            \T_WHILE,
            \T_DECLARE,
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
         * Ignore control structures without body.
         */
        if (ControlStructures::hasBody($phpcsFile, $stackPtr) === false) {
            return;
        }

        /*
         * Deal with declare. Declare with alternative syntax does not get the scope opener/closer
         * assigned in the tokens array prior to PHPCS 3.5.4, so let's set those ourselves.
         *
         * @link https://github.com/squizlabs/PHP_CodeSniffer/pull/2843
         */
        if ($tokens[$stackPtr]['code'] === \T_DECLARE && isset($tokens[$stackPtr]['scope_opener']) === false) {
            $declareOpenClose = ControlStructures::getDeclareScopeOpenClose($phpcsFile, $stackPtr);
            if ($declareOpenClose !== false) {
                // Overrule the scope indexes in our local copy of the $tokens array.
                $tokens[$stackPtr]['scope_opener'] = $declareOpenClose['opener'];
                $tokens[$stackPtr]['scope_closer'] = $declareOpenClose['closer'];
            }
        }

        /*
         * Now check if the control structure uses alternative syntax.
         */
        if (isset($tokens[$stackPtr]['scope_opener'], $tokens[$stackPtr]['scope_closer']) === false) {
            // No scope opener found: inline control structure or parse error.
            $phpcsFile->recordMetric($stackPtr, 'Control structure style', 'inline');
            return;
        }

        $opener = $tokens[$stackPtr]['scope_opener'];
        $closer = $tokens[$stackPtr]['scope_closer'];

        if ($tokens[$opener]['code'] !== \T_COLON) {
            // Curly brace syntax (not our concern).
            $phpcsFile->recordMetric($stackPtr, 'Control structure style', 'curly braces');
            return;
        }

        $hasInlineHTML = $phpcsFile->findNext(
            \T_INLINE_HTML,
            $opener,
            $closer
        );

        if ($hasInlineHTML !== false) {
            $phpcsFile->recordMetric($stackPtr, 'Control structure style', 'alternative syntax with inline HTML');
        } else {
            $phpcsFile->recordMetric($stackPtr, 'Control structure style', 'alternative syntax');
        }

        if ($hasInlineHTML !== false && $this->allowWithInlineHTML === true) {
            return;
        }

        $error = 'Using control structures with the alternative syntax - %1$s(): ... end%1$s; - is not allowed.';
        $code  = 'Found' . \ucfirst($tokens[$stackPtr]['content']);
        $data  = [$tokens[$stackPtr]['content']];
        if ($tokens[$stackPtr]['code'] === \T_ELSEIF || $tokens[$stackPtr]['code'] === \T_ELSE) {
            $data = ['if'];
        }

        if ($hasInlineHTML !== false) {
            $code .= 'WithInlineHTML';
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

        if (isset(Collections::$alternativeControlStructureSyntaxCloserTokens[$tokens[$closer]['code']]) === true) {
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
