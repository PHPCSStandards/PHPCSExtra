<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\FunctionDeclarations;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the RequireFinalMethodsInTraits sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\FunctionDeclarations\RequireFinalMethodsInTraitsSniff
 *
 * @since 1.1.0
 */
final class RequireFinalMethodsInTraitsUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            62 => 1,
            63 => 1,
            65 => 1,
            66 => 1,
            68 => 1,
            73 => 1,
            75 => 1,
            77 => 1,
            81 => 1,
            82 => 1,
            83 => 1,
            84 => 1,
            85 => 1,
            86 => 1,
            87 => 1,
            88 => 1,
            89 => 1,
            90 => 1,
            91 => 1,
            92 => 1,
            93 => 1,
            94 => 1,
            95 => 1,
            96 => 1,
        ];
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
