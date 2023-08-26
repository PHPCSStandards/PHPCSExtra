<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\ControlStructures;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DisallowAlternativeSyntax sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\ControlStructures\DisallowAlternativeSyntaxSniff
 *
 * @since 1.0.0
 */
final class DisallowAlternativeSyntaxUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList($testFile = '')
    {
        if ($testFile !== 'DisallowAlternativeSyntaxUnitTest.1.inc') {
            return [];
        }

        return [
            80  => 1,
            82  => 1,
            84  => 1,
            89  => 1,
            93  => 1,
            97  => 1,
            101 => 1,
            110 => 1,
            118 => 1,
            120 => 1,
            122 => 1,
            126 => 1,
            130 => 1,
            134 => 1,
            138 => 1,
            145 => 1,
            151 => 1,
            154 => 1,
            156 => 1,
            165 => 1,
            167 => 1,
            169 => 1,
            174 => 1,
            178 => 1,
            182 => 1,
            186 => 1,
            195 => 1,
            239 => 1,
            245 => 1,
            256 => 1,
            266 => 1,
            279 => 1,
            281 => 1,
            283 => 1,
            330 => 1,
            332 => 1,
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
