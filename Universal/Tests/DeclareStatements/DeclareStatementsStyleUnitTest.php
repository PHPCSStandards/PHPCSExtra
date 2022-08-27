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
 * @covers PHPCSExtra\Universal\Sniffs\DeclareStatements\DeclareStatementsStyleSniff
 *
 * @since 1.0.0
 */
class DeclareStatementsStyleUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            15  => 1,
            19  => 1,
            23  => 1,
            32  => 1,
            41  => 1,
            45  => 1,
            49  => 1,
            50  => 1,
            55  => 1,
            56  => 1,
            63  => 1,
            67  => 1,
            76  => 1,
            85  => 1,
            89  => 1,
            95  => 1,
            104 => 1,
            185 => 1,
            187 => 1,
            189 => 1,
            191 => 1,
            217 => 1,
            226 => 1,
            261 => 1,
            271 => 1,
            331 => 1,
            340 => 1,
            375 => 1,
            385 => 1,
            445 => 1,
            454 => 1,
            463 => 1,
            472 => 1,
        ];
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
