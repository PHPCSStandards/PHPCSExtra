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
 * Unit test class for the StrictComparisons sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Operators\StrictComparisonsSniff
 *
 * @since 1.0.0
 */
class StrictComparisonsUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int>
     */
    public function getErrorList()
    {
        return [
            15 => 1,
            17 => 1,
            21 => 1,
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
