<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\FunctionDeclarations;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the NoLongClosures sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\FunctionDeclarations\NoLongClosuresSniff
 *
 * @since 1.1.0
 */
final class NoLongClosuresUnitTest extends AbstractSniffUnitTest
{

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
            case 'NoLongClosuresUnitTest.1.inc':
                return [
                    102 => 1,
                    105 => 1,
                    108 => 1,
                ];

            case 'NoLongClosuresUnitTest.2.inc':
                return [
                    22 => 1,
                    31 => 1,
                    45 => 1,
                    57 => 1,
                ];

            case 'NoLongClosuresUnitTest.3.inc':
            case 'NoLongClosuresUnitTest.13.inc':
            case 'NoLongClosuresUnitTest.17.inc':
                return [
                    57 => 1,
                ];

            case 'NoLongClosuresUnitTest.5.inc':
            case 'NoLongClosuresUnitTest.6.inc':
            case 'NoLongClosuresUnitTest.10.inc':
            case 'NoLongClosuresUnitTest.11.inc':
            case 'NoLongClosuresUnitTest.14.inc':
            case 'NoLongClosuresUnitTest.16.inc':
            case 'NoLongClosuresUnitTest.18.inc':
            case 'NoLongClosuresUnitTest.19.inc':
            case 'NoLongClosuresUnitTest.20.inc':
            case 'NoLongClosuresUnitTest.21.inc':
                return [
                    45 => 1,
                    57 => 1,
                ];

            case 'NoLongClosuresUnitTest.7.inc':
            case 'NoLongClosuresUnitTest.8.inc':
            case 'NoLongClosuresUnitTest.9.inc':
            case 'NoLongClosuresUnitTest.12.inc':
            case 'NoLongClosuresUnitTest.15.inc':
            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array <int line number> => <int number of warnings>
     */
    public function getWarningList($testFile = '')
    {
        switch ($testFile) {
            case 'NoLongClosuresUnitTest.1.inc':
                return [
                    42 => 1,
                    50 => 1,
                    58 => 1,
                    83 => 1,
                    91 => 1,
                ];

            case 'NoLongClosuresUnitTest.2.inc':
                return [
                    11 => 1,
                ];

            case 'NoLongClosuresUnitTest.3.inc':
            case 'NoLongClosuresUnitTest.17.inc':
                return [
                    45 => 1,
                ];

            case 'NoLongClosuresUnitTest.4.inc':
                return [
                    22 => 1,
                    31 => 1,
                    45 => 1,
                    57 => 1,
                ];

            case 'NoLongClosuresUnitTest.6.inc':
            case 'NoLongClosuresUnitTest.10.inc':
            case 'NoLongClosuresUnitTest.11.inc':
            case 'NoLongClosuresUnitTest.14.inc':
            case 'NoLongClosuresUnitTest.16.inc':
            case 'NoLongClosuresUnitTest.18.inc':
            case 'NoLongClosuresUnitTest.19.inc':
            case 'NoLongClosuresUnitTest.20.inc':
            case 'NoLongClosuresUnitTest.21.inc':
                return [
                    22 => 1,
                    31 => 1,
                ];

            case 'NoLongClosuresUnitTest.13.inc':
                return [
                    31 => 1,
                    45 => 1,
                ];

            case 'NoLongClosuresUnitTest.5.inc':
            case 'NoLongClosuresUnitTest.7.inc':
            case 'NoLongClosuresUnitTest.8.inc':
            case 'NoLongClosuresUnitTest.9.inc':
            case 'NoLongClosuresUnitTest.12.inc':
            case 'NoLongClosuresUnitTest.15.inc':
            default:
                return [];
        }
    }
}
