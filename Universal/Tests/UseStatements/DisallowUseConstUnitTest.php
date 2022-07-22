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
 * Unit test class for the DisallowUseConst sniff.
 *
 * {@internal The current tests are imprecise and not good enough as they don't test that
 * the correct error code is being thrown, which is what some of the tests are about.}
 *
 * @covers PHPCSExtra\Universal\Sniffs\UseStatements\DisallowUseConstSniff
 *
 * @since 1.0.0
 */
final class DisallowUseConstUnitTest extends AbstractSniffUnitTest
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
            case 'DisallowUseConstUnitTest.1.inc':
                return [
                    8  => 1,
                    9  => 1, // WithAlias.
                    11 => 1,
                    12 => 1, // WithAlias.
                    15 => 1, // WithAlias.
                    16 => 1,
                    23 => 1, // WithAlias.
                    30 => 1, // WithAlias.
                    31 => 1, // Note: alias same as name, so not counted as aliased.
                    32 => 1, // GlobalNamespaceWithAlias.
                    33 => 1, // GlobalNamespace. Note: alias same as name, so not counted as aliased.
                    38 => 1,
                ];

            case 'DisallowUseConstUnitTest.2.inc':
                return [
                    9  => 1, // SameNamespace.
                    10 => 1, // SameNamespaceWithAlias.
                    13 => 1,
                    14 => 1,
                    17 => 1,
                    18 => 1, // WithAlias.
                    21 => 1, // GlobalNamespace.
                    29 => 1,
                    30 => 1, // WithAlias.
                    33 => 1,
                    36 => 1, // SameNamespace.
                    37 => 1, // SameNamespaceWithAlias.
                    40 => 1, // GlobalNamespace.
                ];

            case 'DisallowUseConstUnitTest.3.inc':
                return [
                    9  => 1, // SameNamespace.
                    10 => 1, // SameNamespaceWithAlias.
                    13 => 1,
                    14 => 1,
                    17 => 1,
                    18 => 1, // WithAlias.
                    21 => 1, // GlobalNamespace.

                    30 => 1,
                    31 => 1, // WithAlias.
                    34 => 1,
                    36 => 1,
                    37 => 1, // WithAlias.
                    38 => 1,
                    41 => 1, // GlobalNamespace.

                    50 => 1,
                    51 => 1, // WithAlias.
                    54 => 1,
                    57 => 1, // SameNamespace.
                    58 => 1, // SameNamespaceWithAlias.
                    61 => 1, // GlobalNamespace.
                    67 => 1, // SameNamespace. Note: well, not really, but parse error.
                ];

            case 'DisallowUseConstUnitTest.4.inc':
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
