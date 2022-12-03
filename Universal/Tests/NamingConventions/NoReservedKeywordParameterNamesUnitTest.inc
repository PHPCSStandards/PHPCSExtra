<?php

function noReservedKeywords( $parameter, $descriptive_name ) {} // OK.

function hasReservedKeywords( $string, $echo = true ) {} // Bad x 2.
$closure = function ( $foreach, $array, $require ) {}; // Bad x 3.
$fn = fn($callable, $list) => $callable($list); // Bad x 2.

abstract class Foo {
    abstract public function abstractMethod(
        string &$string,
        Foo|false $exit,
        ?int $parent
    ); // Bad x 3.
}
