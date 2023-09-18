<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2021 WoltLab GmbH, 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\CodeAnalysis;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the ForeachUniqueAssignment sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\CodeAnalysis\MixedBooleanOperatorSniff
 *
 * @since 1.2.0
 */
final class MixedBooleanOperatorUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            3  => 1,
            7  => 1,
            12 => 1,
            17 => 1,
            29 => 1,
            31 => 1,
            33 => 1,
            34 => 1,
            35 => 1,
            37 => 1,
            39 => 1,
            41 => 2,
            43 => 2,
            44 => 1,
            47 => 1,
            61 => 1,
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
