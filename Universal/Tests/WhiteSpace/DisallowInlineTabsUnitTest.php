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

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DisallowInlineTabs sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\DisallowInlineTabsSniff
 *
 * @since 1.0.0
 */
final class DisallowInlineTabsUnitTest extends AbstractSniffUnitTest
{

    /**
     * Should this test be skipped for some reason.
     *
     * @return boolean
     */
    protected function shouldSkipTest()
    {
        /*
         * Skip these tests on PHP 5.5 as there is something weird going on
         * which intermittently causes CI to fail on PHP 5.5 (and only on PHP 5.5).
         * It is unclear why the tests would fail, it cannot be reproduced locally,
         * and will some of the time pass on CI as well, so debugging this is
         * next to impossible.
         * But having to continuously restart builds is getting silly.
         */
        return (\PHP_MAJOR_VERSION === 5 && \PHP_MINOR_VERSION === 5);
    }

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

        if ($testFile === 'DisallowInlineTabsUnitTest.5.inc' || $testFile === 'DisallowInlineTabsUnitTest.6.inc') {
            // Set to the default (results in tab width 1).
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
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList($testFile = '')
    {
        // As of PHP 8.3, comments may be tokenized within a "yield from" token, but only for PHPCS < 3.11.0.
        $commentsInYieldFrom = false;
        if (\PHP_VERSION_ID >= 80300 && \version_compare(Config::VERSION, '3.11.0', '<')) {
            $commentsInYieldFrom = true;
        }

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
                    63 => 1,
                    67 => 1,
                    72 => 1,
                    74 => ($commentsInYieldFrom === true ? 1 : 2),
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
                    37 => 1,
                    41 => 1,
                    46 => 1,
                    48 => ($commentsInYieldFrom === true ? 1 : 2),
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
                    37 => 1,
                    41 => 1,
                    46 => 1,
                    48 => ($commentsInYieldFrom === true ? 1 : 2),
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getWarningList()
    {
        return [];
    }
}
