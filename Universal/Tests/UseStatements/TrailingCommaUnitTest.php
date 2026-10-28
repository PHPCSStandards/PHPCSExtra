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
 * Unit test class for the UseStatements\TrailingComma sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\UseStatements\TrailingCommaSniff
 *
 * @since 1.6.0
 */
final class TrailingCommaUnitTest extends AbstractSniffTestCase
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
            case 'TrailingCommaUnitTest.2.inc':
                Helper::setConfigData('php_version', '70100', true, $config); // PHP 7.1.
                break;

            case 'TrailingCommaUnitTest.3.inc':
                Helper::setConfigData('php_version', '70200', true, $config); // PHP 7.2.
                break;

            default:
                Helper::setConfigData('php_version', null, true, $config); // No PHP version set.
                break;
        }
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
            case 'TrailingCommaUnitTest.1.inc':
                return [
                    23  => 1,
                    24  => 1,
                    29  => 1,
                    33  => 1,
                    35  => 1,
                    39  => 1,
                    48  => 1,
                    69  => 1,
                    75  => 1,
                    81  => 1,
                    87  => 1,
                    94  => 1,
                    106 => 1,
                    117 => 1,
                ];

            case 'TrailingCommaUnitTest.2.inc':
                return [
                    14 => 1,
                    22 => 1,
                ];

            case 'TrailingCommaUnitTest.3.inc':
                return [
                    11 => 1,
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
