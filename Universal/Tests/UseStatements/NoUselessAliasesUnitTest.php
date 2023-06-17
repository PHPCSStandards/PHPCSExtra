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
 * Unit test class for the NoUselessAliases sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\UseStatements\NoUselessAliasesSniff
 *
 * @since 1.1.0
 */
final class NoUselessAliasesUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            26 => 1,
            30 => 1,
            32 => 1,
            33 => 1,
            34 => 1,
            36 => 1,
            39 => 1,
            41 => 1,
            45 => 1,
            51 => 1,
            56 => 1,
            59 => 1,
            60 => 1,
            61 => 1,
            68 => 1,
            69 => 1,
            72 => 1,
            76 => 1,
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
