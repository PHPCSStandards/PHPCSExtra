<?php

function foo( $parameter, $descriptive_name ) {} // OK.

function foo( $string, $echo = true ) {} // Bad x 2.
$closure = function ( $foreach, $array, $require ) {}; // Bad x 3.
$fn = fn($callable, $list) => $callable($list); // Bad x 2.

abstract class Foo {
	abstract public function bar($string, $exit); // Bad x 2.
}
