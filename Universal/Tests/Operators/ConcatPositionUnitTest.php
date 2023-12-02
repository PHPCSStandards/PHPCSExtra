<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Operators;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the ConcatPosition sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Operators\ConcatPositionSniff
 *
 * @since 1.2.0
 */
final class ConcatPositionUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            30  => 1,
            36  => 1,
            37  => 1,
            40  => 1,
            43  => 1,
            44  => 1,
            47  => 1,
            49  => 1,
            54  => 1,
            81  => 1,
            84  => 1,
            85  => 1,
            88  => 1,
            89  => 1,
            93  => 1,
            95  => 1,
            98  => 1,
            113 => 1,
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
