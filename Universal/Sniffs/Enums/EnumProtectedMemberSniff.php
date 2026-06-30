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
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Exceptions\ValueError;
use PHPCSUtils\Utils\Constants;
use PHPCSUtils\Utils\FunctionDeclarations;
use PHPCSUtils\Utils\Scopes;

/**
 * Require non-public enum members to be declared "private", not "protected".
 *
 * Enums cannot be extended, so for an enum member "protected" visibility is functionally
 * equivalent to "private".
 *
 * @since 1.6.0
 */
final class EnumProtectedMemberSniff implements Sniff
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
        return [
            \T_FUNCTION,
            \T_CONST,
        ];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @since 1.6.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        if (Scopes::validDirectScope($phpcsFile, $stackPtr, \T_ENUM) === false) {
            // Not a direct member of an enum.
            return;
        }

        if ($phpcsFile->getTokens()[$stackPtr]['code'] === \T_CONST) {
            $errorCode  = 'ConstantFound';
            $memberType = 'constant';

            try {
                $properties = Constants::getProperties($phpcsFile, $stackPtr);
            } catch (ValueError $e) {
                // Parse error/live coding.
                return;
            }

            if ($properties['scope'] !== 'protected') {
                // Not a "protected" constant. Nothing to do.
                return;
            }

            $protectedPtr = $properties['scope_token'];
        } else {
            $errorCode  = 'MethodFound';
            $memberType = 'method';

            $properties = FunctionDeclarations::getProperties($phpcsFile, $stackPtr);
            if ($properties['scope'] !== 'protected') {
                // Not a "protected" method. Nothing to do.
                return;
            }

            $protectedPtr = $phpcsFile->findPrevious(Tokens::$scopeModifiers, ($stackPtr - 1));
        }

        $fix = $phpcsFile->addFixableError(
            'An enum %s should be declared "private" instead of "protected".',
            $protectedPtr,
            $errorCode,
            [$memberType]
        );

        if ($fix === true) {
            $phpcsFile->fixer->replaceToken($protectedPtr, 'private');
        }
    }
}
