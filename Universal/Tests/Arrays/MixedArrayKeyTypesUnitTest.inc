<?php

// OK: Array without keys.
$array = [1, 2];

// OK: All items have numeric keys.
$array = array(
    1 => 'a',
    2 => 'b',
    3 => 'c',
    4 => 'd',
);

// OK: All items have numeric keys.
$array = array(
    'a',
    2 => 'b',
    '3' => 'c',
    4 => 'd',
);

// OK: All items have string keys.
$array = array(
    'a' => 'a',
    'b' => 'b',
    'c' => 'c',
    'd' => 'd',
);

// Mixed numeric first.
$array = [
    12 => 'numeric key',
    'value',
    'string' => 'string key', // Error.
];

// Mixed string first.
$array = [
    'stringA' => 'string key',
    'stringB' => 'string key',
    12 => 'numeric key', // Error.
];

// Mixed string first, implicit numeric.
$array = [
    $var      => 'unknown key',
    'stringA' => 'string key',
    'numeric key', // Error.
    'stringB' => 'string key',
];
