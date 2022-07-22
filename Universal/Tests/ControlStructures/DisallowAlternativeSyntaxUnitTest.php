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
            73  => 1,
            75  => 1,
            77  => 1,
            82  => 1,
            86  => 1,
            90  => 1,
            94  => 1,
            103 => 1,
            111 => 1,
            113 => 1,
            115 => 1,
            119 => 1,
            123 => 1,
            127 => 1,
            131 => 1,
            138 => 1,
            144 => 1,
            146 => 1,
            148 => 1,
            153 => 1,
            157 => 1,
            161 => 1,
            165 => 1,
            174 => 1,
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
