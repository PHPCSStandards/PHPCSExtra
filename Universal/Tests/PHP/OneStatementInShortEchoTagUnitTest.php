<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\PHP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the OneStatementInShortEchoTag sniff.
 *
 * @covers PHPCSExtra\Universal\Sniffs\PHP\OneStatementInShortEchoTagSniff
 *
 * @since 1.0.0
 */
final class OneStatementInShortEchoTagUnitTest extends AbstractSniffUnitTest
{

    /**
     * Returns the lines where errors should occur.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getErrorList($testFile = '')
    {
        switch ($testFile) {
            case 'OneStatementInShortEchoTagUnitTest.1.inc':
                return [
                    19 => 1,
                    22 => 1,
                    29 => 1,
                ];

            case 'OneStatementInShortEchoTagUnitTest.2.inc':
                return [
                    2 => 1,
                ];

            default:
                return [];
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * @return array <int line number> => <int number of errors>
     */
    public function getWarningList()
    {
        return [];
    }
}
