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
 * Unit test class for the FirstClassCallableSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\FirstClassCallableSpacingSniff
 *
 * @since 1.5.0
 */
final class FirstClassCallableSpacingUnitTest extends AbstractSniffTestCase
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
            case 'FirstClassCallableSpacingUnitTest.1.inc':
                return [
                    10 => 1,
                    11 => 1,
                    12 => 2,
                    13 => 2,
                    14 => 1,
                    16 => 1,
                    19 => 2,

                    23 => 1,
                    24 => 1,
                    25 => 2,
                    26 => 2,
                    27 => 1,
                    30 => 1,
                    32 => 1,

                    36 => 1,
                    37 => 1,
                    38 => 2,
                    39 => 2,
                    40 => 2,
                    41 => 1,
                    42 => 1,
                    46 => 2,
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
