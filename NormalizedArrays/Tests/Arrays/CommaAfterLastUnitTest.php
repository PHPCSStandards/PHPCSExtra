<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\NormalizedArrays\Tests\Arrays;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the CommaAfterLast sniff.
 *
 * @covers PHPCSExtra\NormalizedArrays\Sniffs\Arrays\CommaAfterLastSniff
 *
 * @since 1.0.0
 */
final class CommaAfterLastUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'CommaAfterLastUnitTest.1.inc':
                return [
                    52  => 1,
                    53  => 1,
                    75  => 1,
                    79  => 1,
                    87  => 1,
                    89  => 1,
                    91  => 1,
                    96  => 1,
                    103 => 1,
                    114 => 1,
                    115 => 1,
                    136 => 1,
                    140 => 1,
                    148 => 1,
                    150 => 1,
                    152 => 1,
                    159 => 1,
                    166 => 1,
                ];

            case 'CommaAfterLastUnitTest.2.inc':
                // This test will only work for PHP 7.3+.
                if (\PHP_VERSION_ID < 70300) {
                    return [];
                }

                return [
                    31 => 1,
                    37 => 1,
                    43 => 1,
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array <int line number> => <int number of warnings>
     */
    public function getWarningList()
    {
        return [];
    }
}
