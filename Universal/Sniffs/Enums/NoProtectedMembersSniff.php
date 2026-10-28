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
use PHPCSUtils\Exceptions\ValueError;
use PHPCSUtils\Utils\Constants;
use PHPCSUtils\Utils\FunctionDeclarations;
use PHPCSUtils\Utils\ObjectDeclarations;

/**
 * Require non-public enum members to be declared "private", not "protected".
 *
 * Enums cannot be extended, so for an enum member "protected" visibility is functionally
 * equivalent to "private".
 *
 * @since 1.6.0
 */
final class NoProtectedMembersSniff implements Sniff
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
        return [\T_ENUM];
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
        $constants = ObjectDeclarations::getDeclaredConstants($phpcsFile, $stackPtr);

        foreach ($constants as $constantName => $constantPtr) {
            try {
                $properties = Constants::getProperties($phpcsFile, $constantPtr);
            } catch (ValueError $e) {
                // Parse error/live coding.
                continue;
            }

            if ($properties['scope'] !== 'protected') {
                // Not a "protected" constant. Nothing to do.
                continue;
            }

            $protectedPtr = $properties['scope_token'];
            $finalPtr     = $properties['final_token'];

            $this->handleProtectedMember(
                $phpcsFile,
                $protectedPtr,
                $finalPtr,
                'ConstantFound',
                'constant',
                $constantName
            );
        }

        $methods = ObjectDeclarations::getDeclaredMethods($phpcsFile, $stackPtr);

        foreach ($methods as $methodName => $methodPtr) {
            $properties = FunctionDeclarations::getProperties($phpcsFile, $methodPtr);
            if ($properties['scope'] !== 'protected') {
                // Not a "protected" method. Nothing to do.
                continue;
            }

            $protectedPtr = $phpcsFile->findPrevious(\T_PROTECTED, ($methodPtr - 1));
            $finalPtr     = false;
            if ($properties['is_final'] === true) {
                $finalPtr = $phpcsFile->findPrevious(\T_FINAL, ($methodPtr - 1));
            }

            $this->handleProtectedMember(
                $phpcsFile,
                $protectedPtr,
                $finalPtr,
                'MethodFound',
                'method',
                $methodName . '()'
            );
        }
    }

    /**
     * Handles a protected enum member.
     *
     * @since 1.6.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile    The file being scanned.
     * @param int                         $protectedPtr The position of the "protected" token in the stack.
     * @param int|false                   $finalPtr     The position of the "final" token in the stack
     *                                                  or FALSE if the member is not declared as final.
     * @param string                      $errorCode    The error code to use.
     * @param string                      $memberType   The type of the member ("constant" or "method").
     * @param string                      $memberName   The name of the member, including "()" for methods.
     *
     * @return void
     */
    private function handleProtectedMember(
        File $phpcsFile,
        $protectedPtr,
        $finalPtr,
        $errorCode,
        $memberType,
        $memberName
    ) {
        $error = 'The enum %s "%s" should be declared "private" instead of "protected".';
        if ($finalPtr !== false) {
            $error .= ' The "final" modifier should be removed as "private" members are implicitly final.';
        }

        $fix = $phpcsFile->addFixableError(
            $error,
            $protectedPtr,
            $errorCode,
            [$memberType, $memberName]
        );

        if ($fix === true) {
            $phpcsFile->fixer->beginChangeset();

            $phpcsFile->fixer->replaceToken($protectedPtr, 'private');

            // Private members are implicitly final, so remove the redundant "final" keyword.
            if ($finalPtr !== false) {
                $tokens = $phpcsFile->getTokens();

                $phpcsFile->fixer->replaceToken($finalPtr, '');

                // Prevent leaving behind trailing whitespace.
                for ($i = ($finalPtr + 1); $tokens[$i]['code'] === \T_WHITESPACE; $i++) {
                    $phpcsFile->fixer->replaceToken($i, '');
                }
            }

            $phpcsFile->fixer->endChangeset();
        }
    }
}
