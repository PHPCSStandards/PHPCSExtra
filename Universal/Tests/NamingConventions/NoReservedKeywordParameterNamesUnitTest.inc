<?php

function noReservedKeywords( $parameter, $descriptive_name ) {} // OK.

function hasReservedKeywords( $string, $echo = true ) {} // Bad x 2.
$closure = function ( $foreach, $array, $require ) {}; // Bad x 3.
$fn = fn($callable, $__FILE__) => $callable($__FILE__); // Bad x 2.

abstract class Foo {
    abstract public function abstractMethod(
        string &$string,
        Foo|false $exit,
        ?int $parent
    ); // Bad x 3.
}

/*
 * Tests using less conventional param name casing.
 */
function noReservedKeywordsCasedParams( $Parameter, $DescriptiveName ) {} // OK.

function hasReservedKeywordsCasedParams( $String, $ECHO = true ) {} // Bad x 2.
$closure = function ( $forEach, $Array, $REQUIRE ) {}; // Bad x 3.
$fn = fn($Callable, $__file__) => $Callable($__file__); // Bad x 2.

abstract class Bar {
    abstract public function abstractMethodCasedParams(
        string &$STRING,
        Foo|false $Exit,
        ?int $PaReNt
    ); // Bad x 3.
}

// No parameters, nothing to do.
function noParam() {}

// Live coding/parse error. This has to be the last test in the file.
function liveCoding($echo
