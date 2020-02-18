<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\ControlStructures;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the IfElseDeclaration sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\ControlStructures\IfElseDeclarationSniff
 *
 * @since 1.0.0
 */
class IfElseDeclarationUnitTest extends AbstractSniffUnitTest
{

    /**
     * Set the tabWidth to make sure that the "respecting tab indentation" feature is also tested.
     *
     * @param string                  $testFile The name of the file being tested.
     * @param \PHP_CodeSniffer\Config $config   The config data for the test run.
     *
     * @return void
     */
    public function setCliValues($testFile, $config)
    {
        $config->tabWidth = 4;
    }

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            79  => 1,
            85  => 1,
            87  => 1,
            91  => 1,
            94  => 1,
            96  => 1,
            107 => 1,
            113 => 1,
            115 => 1,
            119 => 1,
            126 => 1,
            131 => 2,
            136 => 1,
        ];
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
