<?php

if (true && true || true); // Not OK.
if ((true && true) || true);
if (true && (true || true));

$var = true && true || true; // Not OK.
$var = (true && true) || true;
$var = true && (true || true);

$complex = true && (true || true) && true;
$complex = true && (true || true) || true; // Not OK.

if (
    true
    && true
    || true // Not OK.
);

if (
    true
    && (
        true
        || true
    )
);

if (true && foo(true || true));
if (true && foo(true && true || true)); // Not OK.
if (true && $foo[true || true]);
if (true && $foo[true && true || true]); // Not OK.

if (true && foo(true) || true); // Not OK.
if (true && $foo[true] || true); // Not OK.
if (true && foo($foo[true]) || true); // Not OK.

$foo[] = true && true || false; // Not OK.

foo([true && true || false]); // Not OK.

if (true && true || true && true); // Not OK.

$foo = false || true && (#[\Attr(true && true || true)] function (#[\SensitiveParameter] $p) { // Not OK.
    echo true || true && true; // Not OK.

    return true;
})('dummy') || false;

$foo = false || (true && (#[\Attr((true && true) || true)] function (#[\SensitiveParameter] $p) {
    echo (true || true) && true;

    return true;
})('dummy')) || false;

$foo = true || true || (#[\Attr(true && true && true)] function (#[\SensitiveParameter] $p) {
    echo true && true && true;

    return true;
})('dummy') || false;

if (true && [true, callMe(), ${true || true}] || true); // Not OK.
if (true && [true, callMe(), ${true || true}] && true);
