<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\CodeAnalysis;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the NoDoubleNegative sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\CodeAnalysis\NoDoubleNegativeSniff
 *
 * @since 1.2.0
 */
final class NoDoubleNegativeUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            16  => 1,
            18  => 1,
            19  => 1,
            20  => 1,
            21  => 1,
            22  => 1,
            24  => 1,
            30  => 1,
            34  => 1,
            43  => 1,
            45  => 1,
            46  => 1,
            47  => 1,
            49  => 1,
            50  => 1,
            51  => 1,
            53  => 1,
            59  => 1,
            60  => 1,
            61  => 1,
            62  => 1,
            63  => 1,
            64  => 1,
            65  => 1,
            68  => 1,
            69  => 1,
            70  => 1,
            71  => 1,
            74  => 1,
            81  => 1,
            84  => 1,
            86  => 1,
            88  => 1,
            89  => 1,
            90  => 1,
            92  => 1,
            94  => 1,
            95  => 1,
            97  => 1,
            98  => 1,
            100 => 1,
        ];
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
