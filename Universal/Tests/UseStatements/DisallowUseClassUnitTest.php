<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Tests\UseStatements;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the DisallowUseClass sniff.
 *
 * {@internal The current tests are imprecise and not good enough as they don't test that
 * the correct error code is being thrown, which is what some of the tests are about.}
 *
 * @covers PHPCSExtra\Universal\Sniffs\UseStatements\DisallowUseClassSniff
 *
 * @since 1.0.0
 */
class DisallowUseClassUnitTest extends AbstractSniffUnitTest
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
            case 'DisallowUseClassUnitTest.1.inc':
                return [
                    8  => 1,
                    9  => 1, // WithAlias.
                    11 => 1, // WithAlias.
                    12 => 1,
                    13 => 1,
                    14 => 1,
                    17 => 1,
                    18 => 1,
                    19 => 1, // WithAlias.
                    24 => 1,
                    28 => 1,
                    33 => 1, // WithAlias.
                    34 => 1,
                    35 => 1, // GlobalNamespaceWithAlias.
                    36 => 1, // GlobalNamespace. Note: alias same as name, so not counted as aliased.
                ];

            case 'DisallowUseClassUnitTest.2.inc':
                return [
                    9  => 1, // SameNamespace.
                    10 => 1, // SameNamespaceWithAlias.
                    13 => 1,
                    14 => 1,
                    17 => 1,
                    18 => 1, // WithAlias.
                    19 => 1,
                    22 => 1, // GlobalNamespace.
                    31 => 1,
                    32 => 1, // WithAlias.
                    35 => 1,
                    37 => 1,
                    39 => 1, // SameNamespaceWithAlias.
                    40 => 1, // SameNamespace.
                    43 => 1, // GlobalNamespace.
                ];

            case 'DisallowUseClassUnitTest.3.inc':
                return [
                    9  => 1, // SameNamespace.
                    10 => 1, // SameNamespaceWithAlias.
                    13 => 1,
                    14 => 1,
                    17 => 1,
                    18 => 1, // WithAlias.
                    19 => 1,
                    22 => 1, // GlobalNamespace.
                    31 => 1,
                    32 => 1, // WithAlias.
                    35 => 1,
                    37 => 1, // WithAlias.
                    38 => 1,
                    41 => 1, // GlobalNamespace.
                    50 => 1,
                    51 => 1, // WithAlias.
                    54 => 1,
                    56 => 1,
                    58 => 1, // SameNamespaceWithAlias.
                    59 => 1, // SameNamespace.
                    62 => 1, // GlobalNamespace.
                    68 => 1, // SameNamespace. Note: well, not really, but parse error.
                ];

            case 'DisallowUseClassUnitTest.4.inc':
                return [
                    6 => 1,
                ];

            default:
                return [];
        }
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
