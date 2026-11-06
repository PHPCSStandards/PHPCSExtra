<?php

/*
 * This test file is run with php_version set to 70100.
 *
 * Missing trailing commas will not be flagged, as trailing commas in group use statements
 * are only supported since PHP 7.2. Trailing commas which are found will still be flagged.
 */
use Vendor\Valid\{
    ValidA,
    ValidB
};

use Vendor\Found\{FoundA, FoundB,};

// phpcs:set Universal.UseStatements.TrailingComma singleLine enforce
// phpcs:set Universal.UseStatements.TrailingComma multiLine forbid
use Vendor\SingleEnforce\{ValidC, ValidD};

use Vendor\MultiForbid\{
    FoundC,
    FoundD,
};
// Resetting to the default values.
// phpcs:set Universal.UseStatements.TrailingComma singleLine forbid
// phpcs:set Universal.UseStatements.TrailingComma multiLine enforce
