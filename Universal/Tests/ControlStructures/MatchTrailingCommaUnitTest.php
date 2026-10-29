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

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;

/**
 * Unit test class for the MatchTrailingComma sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\ControlStructures\MatchTrailingCommaSniff
 *
 * @since 1.6.0
 */
final class MatchTrailingCommaUnitTest extends AbstractSniffTestCase
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
            case 'MatchTrailingCommaUnitTest.1.inc':
                return [
                    25  => 1,
                    26  => 1,
                    30  => 1,
                    34  => 1,
                    36  => 1,
                    41  => 2,
                    50  => 1,
                    71  => 1,
                    77  => 1,
                    83  => 1,
                    89  => 1,
                    96  => 1,
                    101 => 1,
                    114 => 1,
                    125 => 1,
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
