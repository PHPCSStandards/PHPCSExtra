<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Common;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Verifies that enum case names are declared using PascalCase.
 *
 * By default, PascalCase is interpreted strictly: a name must start with an uppercase letter and
 * must not contain two consecutive uppercase letters, so "JsonValue" is accepted while "JSONValue"
 * is not. This can be changed via the `allowConsecutiveCaps` property.
 *
 * @since 1.6.0
 */
final class EnumCaseNameSniff implements Sniff
{

    /**
     * Whether to allow consecutive uppercase letters in enum case names.
     *
     * Defaults to `false`. When set to `true`, names like "JSONValue" are accepted as well.
     *
     * @since 1.6.0
     *
     * @var bool
     */
    public $allowConsecutiveCaps = false;

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

        $strict = ($this->allowConsecutiveCaps !== true);

        if (Common::isCamelCaps($caseName, true, true, $strict) === true) {
            return;
        }

        $errorMessage = 'Enum case name "%s" is not in PascalCase';
        $errorCode    = 'NotPascalCaseAllowConsecutiveCaps';

        if ($strict === true) {
            $errorCode = 'NotPascalCase';

            // Check the name again in non-strict mode. If it passes, the only problem is the
            // consecutive uppercase letters, so let the user know.
            if (Common::isCamelCaps($caseName, true, true, false) === true) {
                $errorMessage .= ' (consecutive uppercase letters are not allowed)';
            }
        }

        $phpcsFile->addError($errorMessage, $caseNamePtr, $errorCode, [$caseName]);
    }
}
