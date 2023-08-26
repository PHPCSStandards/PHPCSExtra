<?php

/*
 * This test file is run with php_version set to a value of 50300.
 *
 * The `FileConstant` error code should trigger, but the `Nested` error code
 * should be ignored as the PHP version is too low.
 */

$path = dirname(__FILE__);
$path = dirname(dirname(__DIR__));
