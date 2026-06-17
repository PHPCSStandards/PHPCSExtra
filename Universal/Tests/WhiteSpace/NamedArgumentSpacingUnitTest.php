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
                    16 => 1,
                    17 => 1,
                    18 => 2,
                    19 => 2,
                    21 => 1,
                    22 => 1,
                    28 => 1,
                    29 => 1,
                    33 => 1,
                    34 => 1,
                    39 => 1,
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
