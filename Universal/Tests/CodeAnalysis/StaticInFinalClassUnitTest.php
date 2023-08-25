<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\CodeAnalysis;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the UnnecessaryStaticInFinalClass sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\CodeAnalysis\StaticInFinalClassSniff
 *
 * @since 1.0.0
 */
final class StaticInFinalClassUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            109 => 1,
            111 => 1,
            112 => 1,
            114 => 1,
            116 => 1,
            123 => 1,
            125 => 1,
            126 => 1,
            131 => 1,
            133 => 1,
            142 => 1,
            144 => 1,
            145 => 1,
            150 => 1,
            152 => 1,
            159 => 1,
            160 => 1,
            161 => 1,
            163 => 1,
            165 => 1,
            171 => 2,
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
