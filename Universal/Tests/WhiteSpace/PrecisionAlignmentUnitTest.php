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
use PHPCSUtils\BackCompat\Helper;

/**
 * Unit test class for the PrecisionAlignment sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\PrecisionAlignmentSniff
 *
 * @since 1.0.0
 */
final class PrecisionAlignmentUnitTest extends AbstractSniffUnitTest
{

    /**
     * Tab-indented test files.
     *
     * @var array<string, int> File name => tab width to set.
     */
    private $tabBasedFiles = [
        'PrecisionAlignmentUnitTest.5.inc'  => 4,
        'PrecisionAlignmentUnitTest.6.inc'  => 4,
        'PrecisionAlignmentUnitTest.7.inc'  => 3,
        'PrecisionAlignmentUnitTest.8.inc'  => 2,
        'PrecisionAlignmentUnitTest.10.inc' => 4,
        'PrecisionAlignmentUnitTest.11.inc' => 4,
        'PrecisionAlignmentUnitTest.15.inc' => 4,
        'PrecisionAlignmentUnitTest.17.inc' => 4,
        'PrecisionAlignmentUnitTest.2.css'  => 4,
        'PrecisionAlignmentUnitTest.2.js'   => 4,
    ];

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
        if (isset($this->tabBasedFiles[$testFile]) === true) {
            $config->tabWidth = $this->tabBasedFiles[$testFile];
        } else {
            $config->tabWidth = 0;
        }

        // Testing a file with "--ignore-annotations".
        if ($testFile === 'PrecisionAlignmentUnitTest.18.inc') {
            $config->annotations = false;
        } else {
            $config->annotations = true;
        }
    }

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [];
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int> Key is the line number, value is the number of expected warnings.
     */
    public function getWarningList($testFile = '')
    {
        $phpcsVersion = Helper::getVersion();
        $isPhpcs4     = \version_compare($phpcsVersion, '3.99.99', '>');

        switch ($testFile) {
            case 'PrecisionAlignmentUnitTest.1.inc': // Space-based, default indent.
            case 'PrecisionAlignmentUnitTest.2.inc': // Space-based, custom indent 4.
            case 'PrecisionAlignmentUnitTest.3.inc': // Space-based, custom indent 3.
            case 'PrecisionAlignmentUnitTest.5.inc': // Tab-based, default indent, tab-width 4.
            case 'PrecisionAlignmentUnitTest.6.inc': // Tab-based, custom indent 4, tab-width 4.
            case 'PrecisionAlignmentUnitTest.7.inc': // Tab-based, custom indent 3, tab-width 3.
                return [
                    23 => 1,
                    29 => 1,
                    36 => 1,
                    39 => 1,
                    40 => 1,
                    41 => 1,
                    48 => 1,
                    49 => 1,
                    51 => 1,
                    54 => 1,
                    57 => 1,
                    81 => 1,
                ];

            case 'PrecisionAlignmentUnitTest.4.inc': // Space-based, custom indent 2.
            case 'PrecisionAlignmentUnitTest.8.inc': // Tab-based, custom indent 2, tab-width 2.
                return [
                    29 => 1,
                    39 => 1,
                    40 => 1,
                    41 => 1,
                    48 => 1,
                    49 => 1,
                    51 => 1,
                    54 => 1,
                    57 => 1,
                    81 => 1,
                ];

            // Verify handling of files only containing short open echo tags.
            case 'PrecisionAlignmentUnitTest.9.inc': // Space-based.
            case 'PrecisionAlignmentUnitTest.10.inc': // Tab-based.
                return [
                    2 => 1,
                    3 => 1,
                    4 => 1,
                    5 => 1,
                    6 => 1,
                ];

            // Verify handling of hereodc/nowdocs closing identifiers.
            case 'PrecisionAlignmentUnitTest.11.inc':
                if (\PHP_VERSION_ID >= 70300) {
                    return [
                        77  => 1,
                        83  => 1,
                        88  => 1,
                        93  => 1,
                        112 => 1,
                        118 => 1,
                        123 => 1,
                        128 => 1,
                    ];
                }

                // PHP 7.2 or lower: PHP version which doesn't support flexible heredocs/nowdocs yet.
                return [];

            case 'PrecisionAlignmentUnitTest.12.inc':
                // Testing that precision alignment on blank lines is ignored.
                return [];

            case 'PrecisionAlignmentUnitTest.13.inc':
                // Testing that precision alignment on blank lines is NOT ignored.
                return [
                    19 => 1,
                    26 => 1,
                    35 => 1,
                    44 => 1,
                    57 => 1,
                    64 => 1,
                    73 => 1,
                    82 => 1,
                ];

            // Testing ignoring the indentation before certain tokens.
            case 'PrecisionAlignmentUnitTest.14.inc': // Space-based.
            case 'PrecisionAlignmentUnitTest.15.inc': // Tab-based.
                return [
                    23 => 1,
                    29 => 1,
                    36 => 1,
                    51 => 1,
                    54 => 1,
                    81 => 1,
                ];

            // Testing ignoring the indentation before certain tokens.
            case 'PrecisionAlignmentUnitTest.16.inc': // Space-based.
            case 'PrecisionAlignmentUnitTest.17.inc': // Tab-based.
                return [
                    39 => 1,
                    40 => 1,
                    41 => 1,
                    48 => 1,
                    49 => 1,
                    51 => 1,
                ];

            // Verify detection of precision alignment for ignore annotation lines.
            case 'PrecisionAlignmentUnitTest.18.inc':
                return [
                    4 => 1,
                ];

            case 'PrecisionAlignmentUnitTest.1.css': // Space-based.
            case 'PrecisionAlignmentUnitTest.2.css': // Tab-based.
                return [
                    5 => ($isPhpcs4 === true ? 0 : 1),
                ];

            case 'PrecisionAlignmentUnitTest.1.js': // Space-based.
            case 'PrecisionAlignmentUnitTest.2.js': // Tab-based.
                return [
                    5 => ($isPhpcs4 === true ? 0 : 1),
                    6 => ($isPhpcs4 === true ? 0 : 1),
                    7 => ($isPhpcs4 === true ? 0 : 1),
                ];

            default:
                return [];
        }
    }
}
