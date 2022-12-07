<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Constants;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the UppercaseMagicConstants sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Constants\UppercaseMagicConstantsSniff
 *
 * @since 1.0.0
 */
final class UppercaseMagicConstantsUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            18 => 1,
            19 => 1,
            20 => 1,
            21 => 1,
            22 => 1,
            23 => 1,
            24 => 1,
            25 => 1,
            27 => 1,
            28 => 1,
            29 => 1,
            30 => 1,
            31 => 1,
            32 => 1,
            33 => 1,
            34 => 1,
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
