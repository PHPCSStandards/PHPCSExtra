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

/**
 * Unit test class for the AnonClassKeywordSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\AnonClassKeywordSpacingSniff
 *
 * @since 1.0.0
 */
final class AnonClassKeywordSpacingUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int>
     */
    public function getErrorList()
    {
        return [
            28 => 1,
            29 => 1,
            30 => 1,
            37 => 1,
            38 => 1,
            39 => 1,
            56 => 1,
            57 => 1,
            60 => 1,
            61 => 1,
            68 => 1,
            69 => 1,
            70 => 1,
            87 => 1,
            88 => 1,
            91 => 1,
            92 => 1,
            93 => 1,
        ];
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];
    }
}
