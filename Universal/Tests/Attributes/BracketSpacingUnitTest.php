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
 * Unit test class for the Attributes\BracketSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Attributes\BracketSpacingSniff
 *
 * @since 1.5.0
 */
final class BracketSpacingUnitTest extends AbstractSniffTestCase
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
            case 'BracketSpacingUnitTest.1.inc':
                return [
                    // No spaces.
                    22  => 2,
                    23  => 1,
                    24  => 1,
                    25  => 2,
                    26  => 1,
                    27  => 1,
                    29  => 1,
                    30  => 1,
                    31  => 1,
                    35  => 1,

                    // One space.
                    57  => 2,
                    58  => 1,
                    59  => 1,
                    62  => 2,
                    63  => 2,
                    64  => 1,
                    65  => 1,

                    // Two spaces.
                    87  => 2,
                    88  => 2,
                    89  => 1,
                    90  => 1,
                    92  => 2,
                    93  => 2,
                    95  => 2,
                    96  => 2,
                    97  => 1,
                    98  => 1,

                    // Ignoring new lines.
                    107 => 2,
                    108 => 2,
                    109 => 1,
                    110 => 1,
                    111 => 1,
                    115 => 1,

                    // Handling of blank lines at start/end.
                    135 => 1,
                    139 => 1,
                    140 => 1,
                    154 => 1,
                    156 => 1,
                    160 => 1,
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
