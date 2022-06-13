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
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            105 => 1,
            107 => 1,
            108 => 1,
            110 => 1,
            112 => 1,
            119 => 1,
            121 => 1,
            122 => 1,
            127 => 1,
            129 => 1,
            138 => 1,
            140 => 1,
            141 => 1,
            146 => 1,
            148 => 1,
            155 => 1,
            156 => 1,
            157 => 1,
            159 => 1,
            161 => 1,
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
