<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\Enums;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Common;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Verifies that enum case names are declared using PascalCase.
 *
 * A name must start with an uppercase letter and may only contain letters and digits.
 * Additionally, consecutive uppercase letters are not allowed, so "JsonValue" is accepted
 * while "JSONValue" is not. This last check uses a separate error code, which can be
 * excluded to allow consecutive uppercase letters.
 *
 * @since 1.6.0
 */
final class CaseNameSniff implements Sniff
{

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @since 1.6.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [\T_ENUM_CASE];
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

        $caseNamePtr = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($caseNamePtr === false || $tokens[$caseNamePtr]['code'] !== \T_STRING) {
            // Live coding/parse error.
            return;
        }

        $caseName = $tokens[$caseNamePtr]['content'];

        if (Common::isCamelCaps($caseName, true, true, false) === false) {
            $phpcsFile->addError(
                'Enum case name "%s" is not in PascalCase',
                $caseNamePtr,
                'NotPascalCase',
                [$caseName]
            );
        }

        if (preg_match('`[A-Z]{2,}`', $caseName) === 1) {
            $phpcsFile->addError(
                'Enum case name "%s" contains consecutive uppercase letters',
                $caseNamePtr,
                'HasConsecutiveCaps',
                [$caseName]
            );
        }
    }
}
