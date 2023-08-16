<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Modernize\Tests\FunctionCalls;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;
use PHPCSUtils\BackCompat\Helper;

/**
 * Unit test class for the Dirname sniff.
 *
 * @covers PHPCSExtra\Modernize\Sniffs\FunctionCalls\DirnameSniff
 *
 * @since 1.0.0
 */
final class DirnameUnitTest extends AbstractSniffUnitTest
{

    /**
     * Set CLI values before the file is tested.
     *
     * @param string                  $testFile The name of the file being tested.
     * @param \PHP_CodeSniffer\Config $config   The config data for the test run.
     *
     * @return void
     */
    public function setCliValues($testFile, $config)
    {
        switch ($testFile) {
            case 'DirnameUnitTest.2.inc':
                Helper::setConfigData('php_version', '50000', true, $config); // PHP 5.0.
                break;

            case 'DirnameUnitTest.3.inc':
                Helper::setConfigData('php_version', '50300', true, $config); // PHP 5.3.
                break;

            case 'DirnameUnitTest.4.inc':
                Helper::setConfigData('php_version', '70000', true, $config); // PHP 7.0.
                break;

            default:
                Helper::setConfigData('php_version', null, true, $config); // No PHP version set.
                break;
        }
    }

    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int>
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'DirnameUnitTest.1.inc':
                return [
                    50  => 1,
                    51  => 1,
                    53  => 1,
                    56  => 1,
                    61  => 1,
                    62  => 1,
                    63  => 1,
                    65  => 1,
                    66  => 1,
                    69  => 1,
                    70  => 1,
                    73  => 1,
                    79  => 3,
                    80  => 3,
                    82  => 1,
                    83  => 2,
                    86  => 1,
                    94  => 1,
                    99  => 1,
                    107 => 1,
                    108 => 1,
                    110 => 2,
                    113 => 3,
                    114 => 3,
                    120 => 4,
                    121 => 4,
                    124 => 4,
                    127 => 1,
                    128 => 1,
                    130 => 1,
                    131 => 1,
                ];

            case 'DirnameUnitTest.3.inc':
                return [
                    10 => 1,
                ];

            case 'DirnameUnitTest.4.inc':
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
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];
    }
}
