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
 * Unit test class for the ArrayBraceSpacing sniff.
 *
 * @covers PHPCSExtra\NormalizedArrays\Sniffs\Arrays\ArrayBraceSpacingSniff
 *
 * @since 1.0.0
 */
class ArrayBraceSpacingUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            11  => 1,
            12  => 1,
            13  => 1,
            18  => 1,
            22  => 1,
            23  => 1,
            25  => 1,
            43  => 1,
            44  => 1,
            52  => 1,
            53  => 1,
            54  => 1,
            57  => 1,
            65  => 1,
            66  => 1,
            67  => 1,
            68  => 1,
            92  => 2,
            93  => 2,
            94  => 1,
            101 => 2,
            102 => 2,
            103 => 2,
            104 => 2,
            129 => 1,
            130 => 1,
            137 => 1,
            139 => 1,
            164 => 1,
            169 => 1,
            196 => 1,
            199 => 1,
            201 => 1,
            210 => 1,
            212 => 1,
            216 => 1,
            220 => 1,
            243 => 1,
            246 => 1,
            248 => 1,
            253 => 1,
            255 => 1,
            257 => 1,
            271 => 1,
            275 => 1,
            279 => 1,
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
