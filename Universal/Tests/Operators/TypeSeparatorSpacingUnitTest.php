<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Operators;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the TypeSeparatorSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Operators\TypeSeparatorSpacingSniff
 *
 * @since 1.0.0
 */
final class TypeSeparatorSpacingUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int>
     */
    public function getErrorList()
    {
        return [
            24 => 4,
            27 => 2,
            28 => 2,
            29 => 4,
            32 => 3,
            33 => 1,
            35 => 5,
            37 => 6,
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
