<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\UseStatements;

use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Utils\UseStatements;

/**
 * Disallow constant import `use` statements.
 *
 * Related sniffs:
 * - `Universal.UseStatements.DisallowUseClass`
 * - `Universal.UseStatements.DisallowUseFunction`
 *
 * @since 1.0.0
 */
class DisallowUseConstSniff implements Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function register()
    {
        return [\T_USE];
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
        try {
            $statements = UseStatements::splitImportUseStatement($phpcsFile, $stackPtr);
        } catch (RuntimeException $e) {
            // Not an import use statement. Bow out.
            return;
        }

        if (empty($statements['const'])) {
            // No import statements for constants found.
            return;
        }

        $tokens         = $phpcsFile->getTokens();
        $endOfStatement = $phpcsFile->findNext([\T_SEMICOLON, \T_CLOSE_TAG], ($stackPtr + 1));

        foreach ($statements['const'] as $alias => $fullName) {
            $reportPtr = $stackPtr;
            do {
                $reportPtr = $phpcsFile->findNext(\T_STRING, ($reportPtr + 1), $endOfStatement, false, $alias);
                if ($reportPtr === false) {
                    // Shouldn't be possible.
                    continue 2;
                }

                $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($reportPtr + 1), $endOfStatement, true);
                if ($next !== false && $tokens[$next]['code'] === \T_NS_SEPARATOR) {
                    // Namespace level with same name. Continue searching
                    continue;
                }

                break;
            } while (true);

            $error  = 'Use import statements for constants are not allowed.';
            $error .= ' Found import statement for: "%s"';
            $data   = [$fullName, $alias];

            $offsetFromEnd = (\strlen($alias) + 1);
            if (\substr($fullName, -$offsetFromEnd) === '\\' . $alias) {
                $phpcsFile->recordMetric($reportPtr, 'Use import statement for constant', 'without alias');

                $phpcsFile->addError($error, $reportPtr, 'FoundWithoutAlias', $data);
                continue;
            }

            $phpcsFile->recordMetric($reportPtr, 'Use import statement for constant', 'with alias');

            $error .= ' with alias: "%s"';
            $phpcsFile->addError($error, $reportPtr, 'FoundWithAlias', $data);
        }
    }
}
