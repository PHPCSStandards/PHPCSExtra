<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Fixers\SpacesFixer;
use PHPCSUtils\Utils\Parentheses;

/**
 * Checks the spacing around the colon for named arguments in function calls.
 *
 * By default, the sniff enforces the PER Coding Style rule that there must be no space
 * between the argument name and the colon, and exactly one space between the colon and
 * the argument value.
 *
 * @since 1.6.0
 */
final class NamedArgumentSpacingSniff implements Sniff
{

    /**
     * The number of spaces to demand between the named argument name and the colon.
     *
     * @since 1.6.0
     *
     * @var int
     */
    public $spacingBefore = 0;

    /**
     * The number of spaces to demand between the colon and the named argument value.
     *
     * @since 1.6.0
     *
     * @var int
     */
    public $spacingAfter = 1;

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @since 1.6.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [\T_PARAM_NAME];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @since 1.6.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the token stack.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // The colon is guaranteed to be the next non-empty token after the T_PARAM_NAME token.
        $colon = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);

        $parenthesisCloser = Parentheses::getLastCloser($phpcsFile, $stackPtr);
        if ($parenthesisCloser === false) {
            // Parse error/live coding: the named argument is not inside a closed set of parentheses.
            return;
        }

        // Find the start of the value being passed, which must sit inside the parentheses.
        $afterColonNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($colon + 1), $parenthesisCloser, true);
        if ($afterColonNonEmpty === false || $tokens[$afterColonNonEmpty]['code'] === \T_COMMA) {
            // Parse error or live coding: no named argument value. Bail out here to prevent fixer conflicts with comma
            // or closing parenthesis spacing sniffs.
            return;
        }

        $spacingBefore = (int) $this->spacingBefore;
        $spacingAfter  = (int) $this->spacingAfter;

        // Check the spacing between the argument name and the colon.
        SpacesFixer::checkAndFix(
            $phpcsFile,
            $stackPtr,
            $colon,
            $spacingBefore,
            'Expected %s between the named argument name and the colon. Found: %s.',
            'SpacingBefore',
            'error',
            0,
            'Named argument: space before colon'
        );

        // Check the spacing between the colon and the argument value.
        SpacesFixer::checkAndFix(
            $phpcsFile,
            $colon,
            $afterColonNonEmpty,
            $spacingAfter,
            'Expected %s between the named argument colon and the value. Found: %s.',
            'SpacingAfter',
            'error',
            0,
            'Named argument: space after colon'
        );
    }
}
