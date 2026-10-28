<?php

/*
 * This test file is run with php_version set to 70200.
 *
 * Missing trailing commas will be flagged, as trailing commas in group use statements
 * are supported since PHP 7.2.
 */
use Vendor\Missing\{
    MissingA,
    MissingB
};
