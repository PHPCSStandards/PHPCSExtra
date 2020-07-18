<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\Constants;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the LowercaseClassResolutionKeyword sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\Constants\LowercaseClassResolutionKeywordSniff
 *
 * @since 1.0.0
 */
class LowercaseClassResolutionKeywordUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList()
    {
        return [
            27 => 1,
            29 => 1,
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
