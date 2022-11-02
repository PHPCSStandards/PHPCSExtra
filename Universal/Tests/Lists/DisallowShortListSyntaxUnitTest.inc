<?php
// Short array, not short list.
$var = [1,2,3];

// Array access, not short list.
$var[1];

list($a) = $array;
[$a] = $array;
list($a, list($b, $c, $d)) = $array;
[$a, [$b, $c, $d]] = $array;
[$a[], [$a[], $a[], $a[],],] = $array;
[
    $a,
    [
        $b,
        $c,
        $d,
    ],
] = $array;

// Test for a specific tokenizer issue which still exists in PHPCS 3.7.1 (fixed in 3.7.2).
if ( true )
    [ $a ] = [ 'hi' ];
return $a ?? '';

// Short list in short array.
$array = [
    'key' => [$a, $b] = $args,
];

// Intentional parse error. This has to be the last test in the file.
[ $a, $b
