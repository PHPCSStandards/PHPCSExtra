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

use PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase;

/**
 * Unit test class for the FnKeywordSpacing sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\WhiteSpace\FnKeywordSpacingSniff
 *
 * @since 1.6.0
 */
final class FnKeywordSpacingUnitTest extends AbstractSniffTestCase
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array<int, int> Key is the line number, value is the number of expected errors.
     */
    public function getErrorList()
    {
        return [
            15 => 1,
            16 => 1,
            17 => 1,
            19 => 1,
            21 => 2,
            23 => 1,
            28 => 1,
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
