<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Enums;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;

/**
 * Unit test class for the EnumProtectedMember sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Enums\EnumProtectedMemberSniff
 *
 * @since 1.6.0
 */
final class EnumProtectedMemberUnitTest extends AbstractSniffTestCase
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
            case 'EnumProtectedMemberUnitTest.1.inc':
                return [
                    56 => 1,
                    57 => 1,
                    58 => 1,
                    59 => 1,
                    62 => 1,
                    68 => 1,
                    69 => 1,
                    71 => 1,
                    81 => 1,
                    82 => 1,
                    83 => 1,
                    84 => 1,
                    85 => 1,
                    86 => 1,
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
