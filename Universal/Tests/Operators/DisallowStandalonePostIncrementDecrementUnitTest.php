<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Operators;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DisallowStandalonePostIncrementDecrement sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Operators\DisallowStandalonePostIncrementDecrementSniff
 *
 * @since 1.0.0
 */
final class DisallowStandalonePostIncrementDecrementUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int>
     */
    public function getErrorList()
    {
        return [
            31 => 1,
            32 => 1,
            33 => 1,
            34 => 1,
            35 => 1,
            36 => 1,
            38 => 1,
            41 => 1,
            42 => 1,
            43 => 1,
            46 => 2,
            48 => 1,
            49 => 1,
            51 => 1,
            52 => 1,
        ];
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [
            57 => 1,
            58 => 1,
        ];
    }
}
