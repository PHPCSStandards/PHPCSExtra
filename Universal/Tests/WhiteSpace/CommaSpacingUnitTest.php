<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\WhiteSpace;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;
use PHPCSUtils\BackCompat\Helper;

/**
 * Unit test class for the CommaSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\CommaSpacingSniff
 *
 * @since 1.1.0
 */
final class CommaSpacingUnitTest extends AbstractSniffUnitTest
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
            case 'CommaSpacingUnitTest.5.inc':
                Helper::setConfigData('php_version', '70313', true, $config); // PHP 7.3.13.
                break;

            case 'CommaSpacingUnitTest.6.inc':
                Helper::setConfigData('php_version', '70000', true, $config); // PHP 7.0.0.
                break;

            default:
                Helper::setConfigData('php_version', null, true, $config); // No PHP version set.
                break;
        }
    }

    /**
     * Filter PHP 7.3+ specific test case files out when the tests are run on PHP < 7.3.
     *
     * Remove the test files which include PHP 7.3+ flexible heredoc/nowdoc
     * code when the tests are run on PHP < 7.3 as the results will never be correct
     * and the fixed file will not match either.
     *
     * @param string $testFileBase The base path that the unit tests files will have.
     *
     * @return string[]
     */
    protected function getTestFiles($testFileBase)
    {
        $testFiles = parent::getTestFiles($testFileBase);

        if (\PHP_VERSION_ID < 70300) {
            foreach ($testFiles as $key => $path) {
                if (\substr($path, -6) === '.5.inc'
                    || \substr($path, -6) === '.6.inc'
                    || \substr($path, -6) === '.7.inc'
                ) {
                    unset($testFiles[$key]);
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
     * @return array<int, int>
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'CommaSpacingUnitTest.1.inc':
                return [
                    85  => 1,
                    86  => 1,
                    87  => 1,
                    88  => 1,
                    91  => 1,
                    92  => 1,
                    93  => 1,
                    99  => 3,
                    101 => 1,
                    106 => 1,
                    107 => 1,
                    111 => 2,
                    115 => 2,
                    116 => 2,
                    117 => 2,
                    122 => 1,
                    124 => 1,
                    126 => 1,
                    131 => 1,
                    132 => 1,
                    137 => 2,
                    138 => 2,
                    139 => 3,
                    143 => 1,
                    144 => 1,
                    145 => 1,
                    146 => 1,
                    149 => 3,
                    150 => 4,
                    154 => 1,
                    157 => 2,
                    158 => 2,
                    161 => 4,
                    162 => 4,
                    166 => 1,
                    168 => 1,
                    174 => 2,
                    178 => 1,
                    182 => 2,
                    186 => 1,
                    189 => 1,
                    195 => 1,
                    196 => 1,
                    197 => 1,
                    201 => 1,
                    202 => 1,
                ];

            // Modular error code check.
            case 'CommaSpacingUnitTest.2.inc':
                return [
                    10 => 3,
                    13 => 3,
                    14 => 3,
                    15 => 3,
                    17 => 3,
                    21 => 3,
                    24 => 3,
                    25 => 3,
                    26 => 3,
                    27 => 3,
                    28 => 3,
                    29 => 3,
                    30 => 3,
                    31 => 3,
                    33 => 3,
                    34 => 3,
                    37 => 3,
                    38 => 3,
                    40 => 3,
                    41 => 3,
                    43 => 6,
                    45 => 3,
                    47 => 3,
                    50 => 3,
                    51 => 3,
                    54 => 3,
                    55 => 3,
                    60 => 3,
                    64 => 3,
                ];

            // Comma before trailing comment.
            case 'CommaSpacingUnitTest.3.inc':
                return [
                    6  => 2,
                    10 => 1,
                    11 => 1,
                    13 => 1,
                    18 => 1,
                    20 => 1,
                    23 => 1,
                    24 => 1,
                ];

            /*
             * PHP 7.3+ flexible heredoc/nowdoc tests.
             * These tests will not be run on PHP < 7.3 as the results will be unreliable.
             * The tests files will be removed from the tests to be run via the overloaded getTestFiles() method.
             */
            case 'CommaSpacingUnitTest.5.inc':
                return [
                    43 => 1,
                    46 => 1,
                    53 => 2,
                    56 => 1,
                ];

            case 'CommaSpacingUnitTest.6.inc':
                return [
                    46 => 1,
                    49 => 1,
                    56 => 2,
                    58 => 1,
                ];

            case 'CommaSpacingUnitTest.7.inc':
                return [
                    47 => 2,
                    49 => 1,
                    56 => 2,
                    59 => 1,
                ];

            // Parse error test.
            case 'CommaSpacingUnitTest.9.inc':
                return [
                    5 => 1,
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];
    }
}
