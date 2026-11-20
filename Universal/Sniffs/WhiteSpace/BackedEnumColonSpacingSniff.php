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

/**
 * Checks the spacing around the colon in a backed enum declaration.
 *
 * @since 1.6.0
 */
final class BackedEnumColonSpacingSniff implements Sniff
{

    /**
     * The number of spaces to demand between the enum name and the colon.
     *
     * @since 1.6.0
     *
     * @var int
     */
    public $spacingBefore = 0;

    /**
     * The number of spaces to demand between the colon and the backing type.
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
        return [\T_ENUM];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @since 1.6.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the token stack.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr]['scope_opener']) === false) {
            // Parse error/live coding.
            return;
        }

        $scopeOpener = $tokens[$stackPtr]['scope_opener'];

        $colon = $phpcsFile->findNext(\T_COLON, ($stackPtr + 1), $scopeOpener);
        if ($colon === false) {
            // Bail as this is a non-backed enum.
            return;
        }

        $enumName = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);

        $spacingBefore = (int) $this->spacingBefore;
        $spacingAfter  = (int) $this->spacingAfter;

        // Check the spacing between the enum name and the colon.
        SpacesFixer::checkAndFix(
            $phpcsFile,
            $enumName,
            $colon,
            $spacingBefore,
            'Expected %s between the enum name and the colon. Found: %s.',
            'SpacingBefore',
            'error',
            0,
            'Backed enum: space before colon'
        );

        $backingType = $phpcsFile->findNext(Tokens::$emptyTokens, ($colon + 1), null, true);
        if ($backingType === false || $tokens[$backingType]['code'] !== \T_STRING) {
            // Parse error/live coding: no backing type.
            return;
        }

        // Check the spacing between the colon and the backing type.
        SpacesFixer::checkAndFix(
            $phpcsFile,
            $colon,
            $backingType,
            $spacingAfter,
            'Expected %s between the colon and the backing type. Found: %s.',
            'SpacingAfter',
            'error',
            0,
            'Backed enum: space after colon'
        );
    }
}
