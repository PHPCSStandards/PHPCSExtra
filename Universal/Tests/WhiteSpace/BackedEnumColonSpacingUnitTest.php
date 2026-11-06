<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\WhiteSpace;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;

/**
 * Unit test class for the BackedEnumColonSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\BackedEnumColonSpacingSniff
 *
 * @since 1.6.0
 */
final class BackedEnumColonSpacingUnitTest extends AbstractSniffTestCase
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
        switch ($testFile) {
            case 'BackedEnumColonSpacingUnitTest.1.inc':
                return [
                    27 => 1,
                    28 => 1,
                    29 => 1,
                    30 => 2,
                    31 => 1,
                    32 => 2,
                    33 => 1,
                    35 => 1,
                    40 => 1,
                    41 => 1,
                    48 => 1,
                    54 => 1,
                    59 => 2,
                ];

            case 'BackedEnumColonSpacingUnitTest.4.inc':
                return [
                    6 => 1,
                ];

            default:
                return [];
        }
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
