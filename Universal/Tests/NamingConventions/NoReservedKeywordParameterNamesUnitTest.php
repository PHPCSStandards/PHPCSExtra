<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\NamingConventions;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the NoReservedKeywordParameterNames sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\NamingConventions\NoReservedKeywordParameterNamesSniff
 *
 * @since 1.0.0
 */
final class NoReservedKeywordParameterNamesUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [];
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array <int line number> => <int number of warnings>
     */
    public function getWarningList()
    {
        return [
            5  => 2,
            6  => 3,
            7  => 2,
            11 => 1,
            12 => 1,
            13 => 1,
            22 => 2,
            23 => 3,
            24 => 2,
            28 => 1,
            29 => 1,
            30 => 1,
        ];
    }
}
