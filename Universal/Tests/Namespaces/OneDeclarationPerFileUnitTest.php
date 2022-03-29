<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Namespaces;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the OneDeclarationPerFile sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Namespaces\OneDeclarationPerFileSniff
 *
 * @since 1.0.0
 */
final class OneDeclarationPerFileUnitTest extends AbstractSniffUnitTest
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
            case 'OneDeclarationPerFileUnitTest.1.inc':
                return [
                    9  => 1,
                    13 => 1,
                    17 => 1,
                ];

            case 'OneDeclarationPerFileUnitTest.2.inc':
                return [
                    10 => 1,
                    15 => 1,
                    20 => 1,
                    26 => 1,
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
