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

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DisallowInlineTabs sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\DisallowInlineTabsSniff
 *
 * @since 1.0.0
 */
class DisallowInlineTabsUnitTest extends AbstractSniffUnitTest
{

    /**
     * Set CLI values before the file is tested.
     *
     * @param string                  $testFile The name of the file being tested.
     * @param \PHP_CodeSniffer\Config $config   The config data for the test run.
     *
     * @return void
     */
    public function setCliValues($testFile, $config)
    {
        if ($testFile === 'DisallowInlineTabsUnitTest.4.inc') {
            $config->tabWidth = 2;
            return;
        }

        if ($testFile === 'DisallowInlineTabsUnitTest.5.inc') {
            // Set to the default.
            $config->tabWidth = 0;
            return;
        }

        $config->tabWidth = 4;
    }

    /**
     * Returns the lines where errors should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'DisallowInlineTabsUnitTest.1.inc':
                return [
                    17 => 1,
                    22 => 1,
                    23 => 1,
                    24 => 1,
                    26 => 1,
                    32 => 1,
                    33 => 1,
                    34 => 1,
                    35 => 1,
                    36 => 1,
                    37 => 1,
                    41 => 1,
                    44 => 2,
                    45 => 2,
                    49 => 1,
                    52 => 1,
                    53 => 1,
                ];

            case 'DisallowInlineTabsUnitTest.2.inc':
                return [
                    2 => 3,
                    3 => 3,
                    5 => 1,
                ];

            case 'DisallowInlineTabsUnitTest.3.inc':
                return [
                    2 => 3,
                    8 => 1,
                ];

            case 'DisallowInlineTabsUnitTest.4.inc':
                return [
                    4  => 1,
                    9  => 1,
                    10 => 1,
                    11 => 1,
                    13 => 1,
                    19 => 1,
                    20 => 1,
                    21 => 1,
                    22 => 1,
                    23 => 1,
                    24 => 1,
                    25 => 1,
                    28 => 1,
                    31 => 1,
                    34 => 1,
                    35 => 1,
                ];

            case 'DisallowInlineTabsUnitTest.5.inc':
                return [
                    4  => 1,
                    9  => 1,
                    10 => 1,
                    11 => 1,
                    13 => 1,
                    19 => 1,
                    20 => 1,
                    21 => 1,
                    22 => 1,
                    23 => 1,
                    24 => 1,
                    28 => 1,
                    31 => 1,
                    34 => 1,
                    35 => 1,
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getWarningList()
    {
        return [];
    }
}
