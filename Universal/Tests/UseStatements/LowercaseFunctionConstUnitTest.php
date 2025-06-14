<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\UseStatements;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;
use PHPCSUtils\BackCompat\Helper;

/**
 * Unit test class for the LowercaseFunctionConst sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\UseStatements\LowercaseFunctionConstSniff
 *
 * @since 1.0.0
 */
final class LowercaseFunctionConstUnitTest extends AbstractSniffTestCase
{

    /**
     * Get a list of all test files to check.
     *
     * @param string $testFileBase The base path that the unit tests files will have.
     *
     * @return array<string>
     */
    protected function getTestFiles($testFileBase)
    {
        $testFiles = parent::getTestFiles($testFileBase);

        if (\version_compare(Helper::getVersion(), '3.99.99', '>') === true) {
            // The issue being tested in the "2" test case file cannot be flagged/fixed on PHPCS 4.0+.
            $target = 'LowercaseFunctionConstUnitTest.2.inc';
            $length = \strlen($target);
            foreach ($testFiles as $i => $fileName) {
                if (\substr($fileName, -$length) === $target) {
                    unset($testFiles[$i]);
                    break;
                }
            }
        }

        return $testFiles;
    }

    /**
     * Returns the lines where errors should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'LowercaseFunctionConstUnitTest.1.inc':
                return [
                    9  => 1,
                    10 => 1,
                    13 => 1,
                    14 => 1,
                    17 => 1,
                    19 => 1,
                ];

            case 'LowercaseFunctionConstUnitTest.2.inc':
                return [
                    9  => 1,
                    10 => 1,
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected warnings.
     */
    public function getWarningList()
    {
        return [];
    }
}
