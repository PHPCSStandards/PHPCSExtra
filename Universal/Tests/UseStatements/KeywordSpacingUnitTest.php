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
     * Get a list of all test files to check.
     *
     * @param string $testFileBase The base path that the unit tests files will have.
     *
     * @return array<string>
     */
    protected function getTestFiles($testFileBase)
    {
        $testFiles = parent::getTestFiles($testFileBase);

        if (\PHP_VERSION_ID < 80000) {
            return $testFiles;
        }

        // The issue being tested in the "2" test case file cannot be flagged/fixed on PHP 8.0+.
        $target = 'KeywordSpacingUnitTest.2.inc';
        $length = \strlen($target);
        foreach ($testFiles as $i => $fileName) {
            if (\substr($fileName, -$length) === $target) {
                unset($testFiles[$i]);
                break;
            }
        }

        return $testFiles;
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
                    71 => 2,
                    72 => 1,
                    73 => 2,
                    74 => 1,
                    75 => 2,
                    79 => 1,
                ];

            case 'KeywordSpacingUnitTest.2.inc':
                return [
                    9 => 1,
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
