<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\DeclareStatements;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Utils\TextStrings;

/**
 * Checks the style of the declare statement
 *
 * `declare` directive can be written in different styles:
 * 1. Applied to the rest of the file, usually written at the top of a file like `declare(strict_types=1);`
 * 2. Applied to a limited scope using curly braces (the exception to this rule is the `strict_types` directive)
 * 3. Applied to a limited scope using alternative control structure syntax
 *
 * You can also have multiple directives written inside the `declare` directive.
 * This sniff will check the style of the `declare` directive - by default applied to all directives,
 * written without braces.
 *
 * You can modify the sniff by changing the `declareStyle` option to require or disallow braces,
 * and require or allow the style to only one of the two directives (`ticks` and `encoding`).
 *
 * @since 1.0.0
 */
class DeclareStatementsStyleSniff implements Sniff
{

    /**
     * Whether to require curly brace style or disallow it
     * when using declare statements.
     *
     * Possible values: requireBraces, disallowBraces.
     *
     * Default is disallowBraces.
     *
     * @var string
     */
    public $declareStyle = 'disallowBraces';

    /**
     * Which declare to enforce the brace style for.
     * If not explicitly defined, the brace style will be applied
     * to all declare directive.
     *
     * The exception is the strict_types directive which cannot be
     * written using curly braces.
     *
     * Possible values: ticks, encoding.
     *
     * @var array
     */
    public $directiveType = [];

    /**
     * Allowed declare directives.
     *
     * @var array
     */
    private $allowedDirectives = [
        'strict_types',
        'ticks',
        'encoding',
    ];

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
            T_DECLARE
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

        $openParenPtr  = $tokens[$stackPtr]['parenthesis_opener'];
        $closeParenPtr = $tokens[$stackPtr]['parenthesis_closer'];

        if (isset($openParenPtr, $closeParenPtr) === false) {
            // Parse error or live coding, bow out.
            return;
        }

        $directiveStrings = [];
        // Get the next string and check if it's an allowed directive.
        // Find all the directive strings inside the declare statement.
        for ($i = $openParenPtr; $i <= $closeParenPtr; $i++) {
            if ($tokens[$i]['code'] === \T_STRING) {
                $directiveStrings[] = $tokens[$i]['content'];
            }
        }

        foreach ($directiveStrings as $directiveString) {
            if (!in_array($directiveString, $this->allowedDirectives, true)) {
                $phpcsFile->addError(
                    sprintf(
                        'Declare directives can be one of: %1$s. "%2$s" found.',
                        implode(', ', $this->allowedDirectives),
                        $directiveString
                    ),
                    $stackPtr,
                    'WrongDeclareDirective'
                );
                return;
            }
            unset($directiveString);
        }

        // Curly braces.
        $hasScopeOpenerCloser = isset($tokens[$stackPtr]['scope_opener']);

        // If strict types is defined using curly brace, throw error.
        if ($hasScopeOpenerCloser !== false && in_array('strict_types', $directiveStrings, true)) {
            $phpcsFile->addError(
                sprintf(
                    'strict_types declaration must not use block mode. Opening brace found on line %d',
                    $tokens[$stackPtr]['line']
                ),
                $stackPtr,
                'Forbidden'
            );
            return;
        }

        // Fix for the case when the code is between the curly braces for the strict_types.
        $codePtr = $phpcsFile->findNext(Tokens::$emptyTokens, ($closeParenPtr + 1), null, true);

        /* If the code pointer is not one of:
         *    \T_SEMICOLON, \T_CLOSE_TAG or \T_OPEN_CURLY_BRACKET, \T_COLON
         * throw an error.
         */
        if (!in_array($tokens[$codePtr]['code'], [\T_SEMICOLON, \T_CLOSE_TAG, \T_OPEN_CURLY_BRACKET, \T_COLON], true)) {
            $phpcsFile->addError(
                'Unexpected code found after opening the declare statement without closing it.',
                $stackPtr,
                'UnexpectedCodeFound'
            );
            return;
        }

        if ($this->declareStyle === 'requireBraces' &&
            $hasScopeOpenerCloser === false &&
            in_array('strict_types', $directiveStrings, true)
        ) {
            $phpcsFile->addError(
                'strict_types declaration is not compatible with requireBraces option.',
                $stackPtr,
                'IncompatibleCurlyBracesRequirement'
            );
            return;
        }

        if ($this->declareStyle === 'disallowBraces' && $hasScopeOpenerCloser !== false) {
            $phpcsFile->addError('Declare statement found using curly braces', $stackPtr, 'DisallowedCurlyBraces');
            return;
        }

        if (in_array('ticks', $this->directiveType, true)) {
            if ($this->declareStyle === 'requireBraces' &&
                $hasScopeOpenerCloser === false &&
                in_array('ticks', $directiveStrings, true)
            ) {
                $phpcsFile->addError(
                    'Declare statement for found without curly braces',
                    $stackPtr,
                    'MissingCurlyBracesTicks'
                );
                return;
            }

            if ($this->declareStyle === 'disallowBraces' && $hasScopeOpenerCloser !== false) {
                $phpcsFile->addError(
                    'Declare statement found using curly braces',
                    $stackPtr,
                    'DisallowedCurlyBracesTicks'
                );
                return;
            }
        }

        if (in_array('encoding', $this->directiveType, true)) {
            if ($this->declareStyle === 'requireBraces' &&
                $hasScopeOpenerCloser === false &&
                in_array('encoding', $directiveStrings, true)
            ) {
                $phpcsFile->addError(
                    'Declare statement found without curly braces',
                    $stackPtr,
                    'MissingCurlyBracesEncoding'
                );
                return;
            }

            if ($this->declareStyle === 'disallowBraces' && $hasScopeOpenerCloser !== false) {
                $phpcsFile->addError(
                    'Declare statement found using curly braces',
                    $stackPtr,
                    'DisallowedCurlyBracesEncoding'
                );
                return;
            }
        }

        if ($this->declareStyle === 'requireBraces' &&
            $hasScopeOpenerCloser === false &&
            empty($this->directiveType) &&
            !in_array('strict_types', $directiveStrings, true)
        ) {
            $phpcsFile->addError('Declare statement found without curly braces', $stackPtr, 'MissingCurlyBraces');
            return;
        }
    }
}
