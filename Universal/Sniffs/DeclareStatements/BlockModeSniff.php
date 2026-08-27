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
 * Checks the style of the declare statement.
 *
 * Declare statements can be written in two different styles:
 * 1. Applied to the rest of the file, usually written at the top of a file like `declare(strict_types=1);`.
 * 2. Applied to a limited scope using curly braces or using alternative control structure syntax
 *    (the exception to this rule is the `strict_types` directive). This is known as block mode.
 *
 * There can be multiple directives inside a `declare` statement.
 * This sniff checks the preferred mode for the `declare` statements.
 *
 * You can modify the sniff by changing the whether the block mode of the encoding and the ticks directives
 * is allowed, disallowed or required. By default, the ticks directive, if written in
 * the block mode won't trigger an error, while encoding and strict_types directives will.
 *
 * strict_types directive is the only one that cannot be modified because it can only be used in
 * a non-block mode.
 *
 * @since 1.0.0
 */
class BlockModeSniff implements Sniff
{

    /**
     * Name of the metric.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const DECLARE_SCOPE_METRIC = 'Declare statement scope';

    /**
     * Name of the metric.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const DECLARE_TYPE_METRIC = 'Declare directive type';

    /**
     * Whether block mode is allowed for `encoding` directives.
     *
     * Can be one of: 'disallow', 'allow' (no preference), or 'require'.
     * Defaults to: 'disallow'.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $encodingBlockMode = 'disallow';

    /**
     * Whether block mode is allowed for `ticks` directives.
     *
     * Can be one of: 'disallow', 'allow' (no preference), or 'require'.
     * Defaults to: 'allow'.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $ticksBlockMode = 'allow';

    /**
     * The default option for the strict_types directive.
     *
     * Block mode is not allowed for the `strict_types` directive.
     * Using it in block mode will throw a PHP fatal error.
     *
     * @since 1.0.0
     *
     * @var string
     */
    private $strictTypesBlockMode = 'disallow';

    /**
     * Allowed declare directives.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $allowedDirectives = [
        'strict_types' => true,
        'ticks'        => true,
        'encoding'     => true,
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
        return [T_DECLARE];
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
            // Parse error or live coding, bow out.
            return;
        }

        $openParenPtr  = $tokens[$stackPtr]['parenthesis_opener'];
        $closeParenPtr = $tokens[$stackPtr]['parenthesis_closer'];

        $directiveStrings = [];
        // Get the next string and check if it's an allowed directive.
        // Find all the directive strings inside the declare statement.
        for ($i = $openParenPtr; $i <= $closeParenPtr; $i++) {
            if ($tokens[$i]['code'] === \T_STRING) {
                $contentsLC = \strtolower($tokens[$i]['content']);
                if (isset($this->allowedDirectives[$contentsLC])) {
                    $phpcsFile->recordMetric($i, self::DECLARE_TYPE_METRIC, $contentsLC);
                    $directiveStrings[$contentsLC] = true;
                }
            }
        }

        unset($i);

        if (empty($directiveStrings)) {
            // No valid directives were found, this is outside the scope of this sniff.
            return;
        }

        $usesBlockMode = isset($tokens[$stackPtr]['scope_opener']);

        if ($usesBlockMode) {
            $phpcsFile->recordMetric($stackPtr, self::DECLARE_SCOPE_METRIC, 'Block mode');
        } else {
            $phpcsFile->recordMetric($stackPtr, self::DECLARE_SCOPE_METRIC, 'File mode');
        }

        // If strict types is defined using block mode, throw error.
        if ($usesBlockMode && isset($directiveStrings['strict_types'])) {
            $error = 'strict_types declaration must not use block mode.';
            $code  = 'Forbidden';

            if (isset($tokens[$stackPtr]['scope_closer'])) {
                // If there is no scope closer, we cannot auto-fix.
                $phpcsFile->addError($error, $stackPtr, $code);
                return;
            }

            $fix = $phpcsFile->addFixableError($error, $stackPtr, $code);

            if ($fix === true) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->addContent($closeParenPtr, ';');
                $phpcsFile->fixer->replaceToken($tokens[$stackPtr]['scope_opener'], '');

                // Remove potential whitespace between parenthesis closer and the brace.
                for ($i = ($tokens[$stackPtr]['scope_opener'] - 1); $i > 0; $i--) {
                    if ($tokens[$i]['code'] !== \T_WHITESPACE) {
                        break;
                    }

                    $phpcsFile->fixer->replaceToken($i, '');
                }

                $phpcsFile->fixer->replaceToken($tokens[$stackPtr]['scope_closer'], '');
                $phpcsFile->fixer->endChangeset();
            }
            return;
        }

        // Check if there is code between the declare statement and opening brace/alternative syntax.
        $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($closeParenPtr + 1), null, true);
        if ($tokens[$nextNonEmpty]['code'] !== \T_SEMICOLON
            && $tokens[$nextNonEmpty]['code'] !== \T_CLOSE_TAG
            && $tokens[$nextNonEmpty]['code'] !== \T_OPEN_CURLY_BRACKET
            && $tokens[$nextNonEmpty]['code'] !== \T_COLON
        ) {
            $phpcsFile->addError(
                'Unexpected code found after the declare statement.',
                $stackPtr,
                'UnexpectedCodeFound'
            );
            return;
        }

        // Multiple directives - if one requires block mode usage, other has to as well.
        if (count($directiveStrings) > 1
            && (($this->encodingBlockMode === 'disallow' && $this->ticksBlockMode !== 'disallow')
                || ($this->ticksBlockMode === 'disallow' && $this->encodingBlockMode !== 'disallow'))
        ) {
            $phpcsFile->addError(
                'Multiple directives found, but one of them is disallowing the use of block mode.',
                $stackPtr,
                'Forbidden' // <= Duplicate error code for different message (line 175)
            );
            return;
        }

        if (($this->encodingBlockMode === 'allow' || $this->encodingBlockMode === 'require')
            && $this->ticksBlockMode === 'disallow'
            && $usesBlockMode && isset($directiveStrings['ticks'])
        ) {
            $phpcsFile->addError(
                'Block mode is not allowed for ticks directive.',
                $stackPtr,
                'DisallowedTicksBlockMode'
            );
            return;
        }

        if ($this->ticksBlockMode === 'require'
            && !$usesBlockMode && isset($directiveStrings['ticks'])
        ) {
            $phpcsFile->addError(
                'Block mode is required for ticks directive.',
                $stackPtr,
                'RequiredTicksBlockMode'
            );
            return;
        }

        if ($this->encodingBlockMode === 'disallow'
            && ($this->ticksBlockMode === 'allow' || $this->ticksBlockMode === 'require')
            && $usesBlockMode && isset($directiveStrings['encoding'])
        ) {
            $phpcsFile->addError(
                'Block mode is not allowed for encoding directive.',
                $stackPtr,
                'DisallowedEncodingBlockMode'
            );
            return;
        }

        if ($this->encodingBlockMode === 'disallow' && $this->ticksBlockMode === 'disallow' && $usesBlockMode) {
            $phpcsFile->addError(
                'Block mode is not allowed for any declare directive.',
                $stackPtr,
                'DisallowedBlockMode'
            );
            return;
        }

        if ($this->encodingBlockMode === 'require'
            && !$usesBlockMode && isset($directiveStrings['encoding'])
        ) {
            $phpcsFile->addError(
                'Block mode is required for encoding directive.',
                $stackPtr,
                'RequiredEncodingBlockMode'
            );
            return;
        }
    }
}
