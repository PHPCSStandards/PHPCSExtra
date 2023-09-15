<?php

if (true && true || true);
if ((true && true) || true);
if (true && (true || true));

$var = true && true || true;
$var = (true && true) || true;
$var = true && (true || true);

$complex = true && (true || true) && true;
$complex = true && (true || true) || true;

if (
    true
    && true
    || true
);

if (
    true
    && (
        true
        || true
    )
);

if (true && foo(true || true));
if (true && foo(true && true || true));
if (true && $foo[true || true]);
if (true && $foo[true && true || true]);

if (true && foo(true) || true);
if (true && $foo[true] || true);
if (true && foo($foo[true]) || true);

$foo[] = true && true || false;

foo([true && true || false]);

if (true && true || true && true);

$foo = false || true && (#[\Attr(true && true || true)] function (#[\SensitiveParameter] $p) {
    echo true || true && true;

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
