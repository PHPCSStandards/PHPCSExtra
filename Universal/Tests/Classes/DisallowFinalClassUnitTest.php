<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Classes;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DisallowFinalClass sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Classes\DisallowFinalClassSniff
 *
 * @since 1.0.0
 */
final class DisallowFinalClassUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            25 => 1,
            27 => 1,
            31 => 1,
            33 => 1,
            36 => 1,
            38 => 1,
            41 => 1,
            44 => 1,
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
