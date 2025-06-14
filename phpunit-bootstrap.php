<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * Bootstrap file for running the tests.
 *
 * - Load the PHPCS PHPUnit bootstrap file to set up the PHPCS native autoloading and some constants.
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

/*
 * Load the necessary PHPCS files.
 */
// Get the PHPCS dir from an environment variable.
$phpcsDir          = \getenv('PHPCS_DIR');
$composerPHPCSPath = __DIR__ . '/vendor/squizlabs/php_codesniffer';

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
    && \file_exists($phpcsDir . '/autoload.php')
    && \file_exists($phpcsDir . '/tests/bootstrap.php')
) {
    require_once $phpcsDir . '/autoload.php';
    require_once $phpcsDir . '/tests/bootstrap.php'; // PHPUnit 6.x+ support.
} else {
    echo 'Uh oh... can\'t find PHPCS.

If you use Composer, please run `composer install`.
Otherwise, make sure you set a `PHPCS_DIR` environment variable in your phpunit.xml file
pointing to the PHPCS directory and that PHPCSUtils is included in the `installed_paths`
for that PHPCS install.
';

    exit(1);
}

// Alias the PHPCS 3.x test case to the PHPCS 4.x name.
if (class_exists('PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest') === true
    && class_exists('PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase') === false
) {
    class_alias(
        'PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest',
        'PHP_CodeSniffer\Tests\Standards\AbstractSniffTestCase'
    );
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
unset($phpcsDir, $composerPHPCSPath, $allStandards, $standardsToIgnore, $standard, $standardsToIgnoreString);
