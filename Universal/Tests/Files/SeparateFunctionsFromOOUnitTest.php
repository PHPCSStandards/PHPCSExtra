<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Files;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the SeparateFunctionsFromOO sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Files\SeparateFunctionsFromOOSniff
 *
 * @since 1.0.0
 */
final class SeparateFunctionsFromOOUnitTest extends AbstractSniffUnitTest
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
            case 'SeparateFunctionsFromOOUnitTest.6.inc':
                return [
                    7 => 1,
                ];

            case 'SeparateFunctionsFromOOUnitTest.7.inc':
                return [
                    11 => 1,
                ];

            case 'SeparateFunctionsFromOOUnitTest.8.inc':
                return [
                    12 => 1,
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array <int line number> => <int number of warnings>
     */
    public function getWarningList()
    {
        return [];
    }
}
