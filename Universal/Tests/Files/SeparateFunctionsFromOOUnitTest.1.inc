<?php

// Valid: File which only declares functions, both global and namespaced.

function fooA() {}

function fooB() {}

function fooC() {}

namespace First;

function firstFooA() {}

function firstFooB() {}

namespace Second;

function secondFooA() {}

if ($a === $b) {
    function secondFooB() {}
}

// This sniff has no rules about side-effects.
$globVar = new class() {
    public function thisIsAnAnonymousClass() {}
};

$closure = function($a, $b) {
    return $a + $b;
};

define('MY_CONSTANT', 'foo');

const ANOTHER_CONSTANT = 'bar';

while ( true ) {
    // Do something.
}
