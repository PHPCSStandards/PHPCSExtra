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
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
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
            155 => 1,
            157 => 1,
            159 => 1,
            164 => 1,
            168 => 1,
            172 => 1,
            176 => 1,
            185 => 1,
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
