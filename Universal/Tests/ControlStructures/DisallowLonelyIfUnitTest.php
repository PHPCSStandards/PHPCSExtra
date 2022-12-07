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
 * Unit test class for the DisallowLonelyIf sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\ControlStructures\DisallowLonelyIfSniff
 *
 * @since 1.0.0
 */
final class DisallowLonelyIfUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            // Basic checks.
            82  => 1,
            86  => 1,
            94  => 1,
            104 => 1,
            116 => 1,

            // Alternative control structure syntax.
            127 => 1,
            135 => 1,
            145 => 1,
            158 => 1,
            170 => 1,

            // Fixer specific tests with comments.
            183 => 1,
            187 => 1,
            195 => 1,
            203 => 1,
            212 => 1,
            221 => 1,
            230 => 1,
            239 => 1,
            248 => 1,
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
