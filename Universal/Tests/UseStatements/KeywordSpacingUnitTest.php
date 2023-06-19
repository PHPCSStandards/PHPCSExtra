<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\UseStatements;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the KeywordSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\UseStatements\KeywordSpacingSniff
 *
 * @since 1.1.0
 */
final class KeywordSpacingUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int>
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'KeywordSpacingUnitTest.1.inc':
                return [
                    48 => 3,
                    49 => 1,
                    51 => 1,
                    55 => 2,
                    58 => 1,
                    59 => 4,
                    60 => 1,
                    62 => 1,
                    63 => 2,
                    65 => 4,
                    66 => 2,
                    68 => 1,
                    70 => 2,
                    71 => 1,
                    72 => 2,
                    73 => 1,
                    74 => 2,
                    78 => 1,
                ];

            case 'KeywordSpacingUnitTest.2.inc':
                if (\PHP_VERSION_ID >= 80000) {
                    return [];
                }

                return [
                    11 => 1,
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];
    }
}
