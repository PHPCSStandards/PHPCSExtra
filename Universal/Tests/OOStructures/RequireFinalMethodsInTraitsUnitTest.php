<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\OOStructures;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the RequireFinalMethodsInTraits sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\OOStructures\RequireFinalMethodsInTraitsSniff
 *
 * @since 1.1.0
 */
final class RequireFinalMethodsInTraitsUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            81  => 1,
            82  => 1,
            84  => 1,
            85  => 1,
            87  => 1,
            92  => 1,
            94  => 1,
            96  => 1,
            101 => 1,
            102 => 1,
            103 => 1,
            104 => 1,
            105 => 1,
            106 => 1,
            107 => 1,
            108 => 1,
            109 => 1,
            110 => 1,
            111 => 1,
            112 => 1,
            113 => 1,
            114 => 1,
            115 => 1,
            116 => 1,
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
