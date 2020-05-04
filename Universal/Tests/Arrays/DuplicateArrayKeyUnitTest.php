<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Arrays;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;
use PHPCSUtils\BackCompat\Helper;

/**
 * Unit test class for the DuplicateArrayKey sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Arrays\DuplicateArrayKeySniff
 *
 * @since 1.0.0
 */
final class DuplicateArrayKeyUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            30  => 1,
            31  => 1,
            37  => 1,
            38  => 1,
            39  => 1,
            40  => 1,
            41  => 1,
            42  => 1,
            43  => 1,
            44  => 1,
            45  => 1,
            46  => 1,
            47  => 1,
            48  => 1,
            49  => 1,
            50  => 1,
            51  => 1,
            52  => 1,
            53  => 1,
            54  => 1,
            55  => 1,
            56  => 1,
            57  => 1,
            64  => 1,
            65  => 1,
            66  => 1,
            67  => 1,
            68  => 1,
            69  => 1,
            70  => 1,
            71  => 1,
            72  => 1,
            73  => 1,
            74  => 1,
            75  => 1,
            76  => 1,
            77  => 1,
            78  => 1,
            79  => 1,
            80  => 1,
            81  => 1,
            82  => 1,
            83  => 1,
            84  => 1,
            90  => 1,
            91  => 1,
            92  => 1,
            93  => 1,
            94  => 1,
            95  => 1,
            96  => 1,
            97  => 1,
            98  => 1,
            99  => 1,
            100 => 1,
            101 => 1,
            102 => 1,
            103 => 1,
            104 => 1,
            105 => 1,
            113 => 1,
            114 => 1,
            118 => 1,
            122 => 1,
            129 => 1,
            132 => 1,
            133 => 1,
            134 => 1,
            135 => 1,
            136 => 1,
            137 => 1,
            138 => 1,
            139 => 1,
            140 => 1,
            141 => 1,
            145 => 1,
            147 => 1,
            148 => 1,
            151 => 1,
            161 => 1,
            162 => 1,
            163 => 1,
            164 => 1,
            165 => 1,
            166 => 1,
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
