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
 * Unit test class for the NamedArgumentSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\NamedArgumentSpacingSniff
 *
 * @since 1.6.0
 */
final class NamedArgumentSpacingUnitTest extends AbstractSniffTestCase
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
            case 'NamedArgumentSpacingUnitTest.1.inc':
                return [
                    19 => 1,
                    20 => 1,
                    21 => 2,
                    22 => 2,
                    23 => 2,
                    24 => 2,
                    25 => 2,
                    27 => 1,
                    28 => 1,
                    34 => 2,
                    35 => 1,
                    36 => 2,
                    40 => 1,
                    41 => 1,
                    45 => 1,
                    46 => 1,
                    51 => 1,
                    57 => 2,
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
