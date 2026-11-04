<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Enums;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;

/**
 * Unit test class for the CaseName sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Enums\CaseNameSniff
 *
 * @since 1.6.0
 */
final class CaseNameUnitTest extends AbstractSniffTestCase
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
            case 'CaseNameUnitTest.1.inc':
                return [
                    27 => 1,
                    28 => 1,
                    29 => 1,
                    32 => 1,
                    36 => 1,
                    44 => 1,
                    45 => 1,
                    46 => 1,
                    47 => 1,
                    55 => 2,
                    56 => 2,
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
