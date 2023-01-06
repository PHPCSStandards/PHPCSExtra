<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\CodeAnalysis;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;
use PHPCSUtils\BackCompat\Helper;

/**
 * Unit test class for the ConstructorDestructorReturn sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\CodeAnalysis\ConstructorDestructorReturnSniff
 *
 * @since 1.0.0
 */
final class ConstructorDestructorReturnUnitTest extends AbstractSniffUnitTest
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
        switch ($testFile) {
            case 'ConstructorDestructorReturnUnitTest.2.inc':
                Helper::setConfigData('php_version', '80025', true, $config); // PHP 8.0.25.
                break;

            case 'ConstructorDestructorReturnUnitTest.3.inc':
                Helper::setConfigData('php_version', '70313', true, $config); // PHP 7.3.13.
                break;

            default:
                Helper::setConfigData('php_version', null, true, $config); // No PHP version set.
                break;
        }
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
            case 'ConstructorDestructorReturnUnitTest.1.inc':
                return [
                    85  => 1,
                    89  => 1,
                    101 => 1,
                    116 => 1,
                    118 => 1,
                    122 => 1,
                    124 => 1,
                ];

            case 'ConstructorDestructorReturnUnitTest.2.inc':
                return [
                    10 => 1,
                    14 => 1,
                ];

            case 'ConstructorDestructorReturnUnitTest.3.inc':
                return [
                    10 => 1,
                    14 => 1,
                    18 => 1,
                ];

            case 'ConstructorDestructorReturnUnitTest.4.inc':
                return [
                    10 => 1,
                ];

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
            case 'ConstructorDestructorReturnUnitTest.1.inc':
                return [
                    86  => 1,
                    90  => 1,
                    95  => 1,
                    103 => 1,
                    107 => 1,
                ];

            case 'ConstructorDestructorReturnUnitTest.2.inc':
                return [
                    11 => 1,
                    15 => 1,
                ];

            case 'ConstructorDestructorReturnUnitTest.3.inc':
                return [
                    11 => 1,
                    15 => 1,
                    20 => 1,
                ];

            case 'ConstructorDestructorReturnUnitTest.4.inc':
                return [
                    12 => 1,
                ];

            default:
                return [];
        }
    }
}
