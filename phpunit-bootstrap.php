<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * Bootstrap file for running the tests.
 *
 * - Load the PHPCS PHPUnit bootstrap file providing cross-version PHPUnit support.
 *   {@link https://github.com/squizlabs/PHP_CodeSniffer/pull/1384}
 * - Allows for a `PHPCS_DIR` environment variable to be set to point to a different
 *   PHPCS install than the one in the `vendor` directory to allow for testing with
 *   a git clone of PHPCS.
 * - Prevent attempting to run unit tests of other external PHPCS standards installed.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

use PHP_CodeSniffer\Util\Standards;

if (\defined('PHP_CODESNIFFER_IN_TESTS') === false) {
    \define('PHP_CODESNIFFER_IN_TESTS', true);
}

$ds = \DIRECTORY_SEPARATOR;

/*
 * Load the necessary PHPCS files.
 */
// Get the PHPCS dir from an environment variable.
$phpcsDir          = \getenv('PHPCS_DIR');
$composerPHPCSPath = __DIR__ . $ds . 'vendor' . $ds . 'squizlabs' . $ds . 'php_codesniffer';

if ($phpcsDir === false && \is_dir($composerPHPCSPath)) {
    // PHPCS installed via Composer.
    $phpcsDir = $composerPHPCSPath;
} elseif ($phpcsDir !== false) {
    /*
     * PHPCS in a custom directory.
     * For this to work, the `PHPCS_DIR` needs to be set in a custom `phpunit.xml` file.
     */
    $phpcsDir = \realpath($phpcsDir);
}

// Try and load the PHPCS autoloader.
if ($phpcsDir !== false
    && \file_exists($phpcsDir . $ds . 'autoload.php')
    && \file_exists($phpcsDir . $ds . 'tests' . $ds . 'bootstrap.php')
) {
    require_once $phpcsDir . $ds . 'autoload.php';
    require_once $phpcsDir . $ds . 'tests' . $ds . 'bootstrap.php'; // PHPUnit 6.x+ support.
} else {
    echo 'Uh oh... can\'t find PHPCS.

If you use Composer, please run `composer install`.
Otherwise, make sure you set a `PHPCS_DIR` environment variable in your phpunit.xml file
pointing to the PHPCS directory and that PHPCSUtils is included in the `installed_paths`
for that PHPCS install.
';

    die(1);
}

/*
 * Set the PHPCS_IGNORE_TEST environment variable to ignore tests from other standards.
 * Ref: https://github.com/squizlabs/PHP_CodeSniffer/pull/1146
 */
$phpcsExtraStandards = [
    'Modernize'        => true,
    'NormalizedArrays' => true,
    'Universal'        => true,
];

$allStandards   = Standards::getInstalledStandards();
$allStandards[] = 'Generic';

$standardsToIgnore = [];
foreach ($allStandards as $standard) {
    if (isset($phpcsExtraStandards[$standard]) === true) {
        continue;
    }

    $standardsToIgnore[] = $standard;
}

$standardsToIgnoreString = \implode(',', $standardsToIgnore);
\putenv("PHPCS_IGNORE_TESTS={$standardsToIgnoreString}");

// Clean up.
unset($ds, $phpcsDir, $composerPHPCSPath, $allStandards, $standardsToIgnore, $standard, $standardsToIgnoreString);
