<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\PHP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the NoFQNTrueFalseNull sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\PHP\NoFQNTrueFalseNullSniff
 *
 * @since 1.3.0
 */
final class NoFQNTrueFalseNullUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            13 => 1,
            14 => 1,
            15 => 1,
            17 => 1,
            18 => 1,
            19 => 1,
            22 => 1,
            24 => 2,
            26 => 2,
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
