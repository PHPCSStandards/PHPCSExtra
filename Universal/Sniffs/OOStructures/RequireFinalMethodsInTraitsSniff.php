<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\OOStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHPCSUtils\Utils\FunctionDeclarations;
use PHPCSUtils\Utils\ObjectDeclarations;
use PHPCSUtils\Utils\Scopes;

/**
 * Require non-abstract, non-private methods in traits to be declared as "final".
 *
 * @since 1.1.0
 */
final class RequireFinalMethodsInTraitsSniff implements Sniff
{

    /**
     * Name of the metric.
     *
     * @since 1.1.0
     *
     * @var string
     */
    const METRIC_NAME = 'Non-private method in trait is abstract or final ?';

    /**
     * Whether or not this rule applies to magic methods.
     *
     * Defaults to `false`.
     *
     * @since 1.1.0
     *
     * @var bool
     */
    public $includeMagicMethods = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.1.0
     *
     * @return array
     */
    public function register()
    {
        return [\T_FUNCTION];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 1.1.0
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
        if (isset($tokens[$stackPtr]['parenthesis_opener']) === false) {
            // Parse error/live coding.
            return;
        }

        $scopePtr = Scopes::validDirectScope($phpcsFile, $stackPtr, \T_TRAIT);
        if ($scopePtr === false) {
            // Not a trait method.
            return;
        }

        $methodName = FunctionDeclarations::getName($phpcsFile, $stackPtr);
        if ($this->includeMagicMethods === false
            && FunctionDeclarations::isMagicMethodName($methodName) === true
        ) {
            // Magic methods are excluded. Bow out.
            return;
        }

        $methodProps = FunctionDeclarations::getProperties($phpcsFile, $stackPtr);
        if ($methodProps['scope'] === 'private') {
            // Private methods can't be final.
            return;
        }

        if ($methodProps['is_final'] === true) {
            // Already final, nothing to do.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'final');
            return;
        }

        if ($methodProps['is_abstract'] === true) {
            // Abstract classes can't be final.
            $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'abstract');
            return;
        }

        $phpcsFile->recordMetric($stackPtr, self::METRIC_NAME, 'not abstract, not final');

        $data = [
            $methodProps['scope'],
            $methodName,
            ObjectDeclarations::getName($phpcsFile, $scopePtr),
        ];

        $fix = $phpcsFile->addFixableError(
            'The non-abstract, %s method "%s()" in trait %s should be declared as final.',
            $stackPtr,
            'NonFinalMethodFound',
            $data
        );

        if ($fix === true) {
            $phpcsFile->fixer->addContentBefore($stackPtr, 'final ');
        }
    }
}
