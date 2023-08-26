<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\OOStructures;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the AlphabeticExtendsImplements sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\OOStructures\AlphabeticExtendsImplementsSniff
 *
 * @since 1.0.0
 */
final class AlphabeticExtendsImplementsUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            30 => 1,
            31 => 1,
            33 => 1,
            34 => 1,
            36 => 1,
            50 => 1,
            51 => 1,
            53 => 1,
            54 => 1,
            62 => 1,
            68 => 1,
            80 => 1,
        ];
    }

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected warnings.
     */
    public function getWarningList()
    {
        return [];
    }
}
