<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\CodeAnalysis;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the ConstructorDestructorReturn sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\CodeAnalysis\ConstructorDestructorReturnSniff
 *
 * @since 1.0.0
 */
final class ConstructorDestructorReturnUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            85  => 1,
            89  => 1,
            101 => 1,
            116 => 1,
            118 => 1,
            122 => 1,
            124 => 1,
        ];
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array <int line number> => <int number of warnings>
     */
    public function getWarningList()
    {
        return [
            86  => 1,
            90  => 1,
            95  => 1,
            103 => 1,
            107 => 1,
        ];
    }
}
