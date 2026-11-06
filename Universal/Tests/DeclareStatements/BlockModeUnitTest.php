<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\DeclareStatements;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DeclareStatementsStyleUnitTest sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\DeclareStatements\BlockModeSniff
 *
 * @since 1.0.0
 */
class BlockModeUnitTest extends AbstractSniffUnitTest
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
            case 'BlockModeUnitTest.1.inc':
                return [
                    21 => 1,
                    25 => 1,
                    29 => 1,
                    38 => 1,
                    47 => 1,
                    51 => 1,
                    55 => 1,
                    56 => 1,
                    60 => 1,
                    69 => 1,
                ];

            case 'BlockModeUnitTest.3.inc':
                return [
                    7  => 1,
                    11 => 1,
                    19 => 1,
                    20 => 1,
                    31 => 1,
                    38 => 1,
                    42 => 1,
                    43 => 1,
                ];

            case 'BlockModeUnitTest.4.inc':
                return [
                    27  => 1,
                    31  => 1,
                    56  => 1,
                    75  => 1,
                    79  => 1,
                    86  => 1,
                    90  => 1,
                    98  => 1,
                    102 => 1,
                    117 => 1,
                    121 => 1,
                    125 => 1,
                    144 => 1,
                    157 => 1,
                    161 => 1,
                    167 => 1,
                    188 => 1,
                    190 => 1,
                ];

            case 'BlockModeUnitTest.5.inc':
                return [
                    51  => 1,
                    55  => 1,
                    56  => 1,
                    66  => 1,
                    86  => 1,
                    111 => 1,
                    117 => 1,
                    126 => 1,
                    134 => 1,
                    135 => 1,
                    144 => 1,
                    148 => 1,
                    172 => 1,
                    181 => 1,
                    185 => 1,
                    192 => 1,
                    213 => 1,
                    229 => 1,
                    239 => 1,
                    245 => 1,
                    248 => 1,
                    268 => 1,
                    276 => 1,
                    281 => 1,
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
