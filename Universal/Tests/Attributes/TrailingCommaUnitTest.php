<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Attributes;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;

/**
 * Unit test class for the Attributes\TrailingComma sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Attributes\TrailingCommaSniff
 *
 * @since 1.5.0
 */
final class TrailingCommaUnitTest extends AbstractSniffTestCase
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
            case 'TrailingCommaUnitTest.1.inc':
                return [
                    // ForbiddenSingleLine.
                    56 => 1,
                    57 => 1,
                    58 => 1,

                    // ForbiddenSingleAttributeMultiLine.
                    63 => 1,
                    66 => 1,

                    // RequiredMultiAttributeMultiLine.
                    73 => 1,
                    76 => 1,
                    81 => 1,
                    87 => 1,
                    91 => 1,
                    95 => 1,
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
