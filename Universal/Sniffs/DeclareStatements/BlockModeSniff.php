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
 * `declare` directives can be written in two different styles:
 * 1. Applied to the rest of the file, usually written at the top of a file like `declare(strict_types=1);`.
 * 2. Applied to a limited scope using curly braces or using alternative control structure syntax
 *    (the exception to this rule is the `strict_types` directive). This is known as a block mode.
 *
 * You can also have multiple directives written inside the `declare` directive.
 * This sniff will check the preferred mode of the `declare` directive.
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
    const DECLARE_SCOPE_METRIC = 'Declare directive scope';

    /**
     * Name of the metric.
     *
     * @since 1.0.0
     *
     * @var string
     */
    const DECLARE_TYPE_METRIC = 'Declare directive type';

    /**
     * The option for the encoding directive.
     *
     * Can be one of: 'disallow', 'allow' (no preference), 'require'.
     * By default it's disallowed.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $encodingBlockMode = 'disallow';

    /**
     * The option for the ticks directive.
     *
     * Can be one of: 'disallow', 'allow' (no preference), 'require'.
     * By default it's allowed.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $ticksBlockMode = 'allow';

    /**
     * The default option for the strict_types directive.
     *
     * Only directive that cannot be written in block mode is strict_types.
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
            if ($tokens[$i]['code'] === \T_STRING
                && isset($this->allowedDirectives[\strtolower($tokens[$i]['content'])])
            ) {
                $directiveStrings[$tokens[$i]['content']] = true;
            }
        }

        unset($i);

        if (empty($directiveStrings)) {
            // No valid directives were found, this is outside the scope of this sniff.
            return;
        }

        $usesBlockMode = isset($tokens[$stackPtr]['scope_opener']);

        if ($usesBlockMode) {
            $phpcsFile->recordMetric($stackPtr, self::DECLARE_SCOPE_METRIC, 'Block');
        } else {
            $phpcsFile->recordMetric($stackPtr, self::DECLARE_SCOPE_METRIC, 'Global');
        }

        // If strict types is defined using block mode, throw error.
        if ($usesBlockMode && isset($directiveStrings['strict_types'])) {
            $phpcsFile->addError(
                'strict_types declaration must not use block mode.',
                $stackPtr,
                'Forbidden'
            );
            return;
        }
		/*
		 * To do: Add a fixer
		 *
		 * But only if strict_types is on its own. In this case we should remove the last brace,
		 * remove the first one, and after the closing parenthesis add a comma.
		 *
		 * Add a fixable test for this case!
		 */

        // Check if there is a code between the declare statement and opening brace/alternative syntax.
        $nextNonEmpty          = $phpcsFile->findNext(Tokens::$emptyTokens, ($closeParenPtr + 1), null, true);
        $directiveCloserTokens = [\T_SEMICOLON, \T_CLOSE_TAG, \T_OPEN_CURLY_BRACKET, \T_COLON];

        if (!in_array($tokens[$nextNonEmpty]['code'], $directiveCloserTokens, true)) {
            $phpcsFile->addError(
                'Unexpected code found after opening the declare statement without closing it.',
                $stackPtr,
                'UnexpectedCodeFound'
            );
            return;
        }

        foreach (\array_keys($directiveStrings) as $directiveString) {
            if (isset($this->allowedDirectives[$directiveString])) {
                $phpcsFile->recordMetric($stackPtr, self::DECLARE_TYPE_METRIC, $directiveString);
            }
        }

        // Multiple directives - if one requires block mode usage, other has to as well.
        if (count($directiveStrings) > 1
            && (($this->encodingBlockMode === 'disallow' && $this->ticksBlockMode !== 'disallow')
                || ($this->ticksBlockMode === 'disallow' && $this->encodingBlockMode !== 'disallow'))
        ) {
            $phpcsFile->addError(
                'Multiple directives found, but one of them is disallowing the use of block mode.',
                $stackPtr,
                'Forbidden'
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
