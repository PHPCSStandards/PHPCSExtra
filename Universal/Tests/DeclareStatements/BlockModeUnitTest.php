<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\DeclareStatements;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DeclareStatementsStyleUnitTest sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\DeclareStatements\DeclareStatementsStyleSniff
 *
 * @since 1.0.0
 */
class DeclareStatementsStyleUnitTest extends AbstractSniffUnitTest
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
            case 'DeclareStatementsStyleUnitTest.1.inc':
                return [
                ];

            case 'DeclareStatementsStyleUnitTest.2.inc':
                return [
                ];

            case 'DeclareStatementsStyleUnitTest.3.inc':
                return [
                ];

            case 'DeclareStatementsStyleUnitTest.4.inc':
                return [
                ];

            case 'DeclareStatementsStyleUnitTest.5.inc':
                return [
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
