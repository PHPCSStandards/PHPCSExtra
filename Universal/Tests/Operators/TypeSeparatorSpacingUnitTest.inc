<?php

/*
 * Correct spacing (even though some of the code is invalid, but that's not the concern of this sniff).
 */
class CorrectSpacing {

    public int|bool|null $property;

    protected function foo(int|bool $paramA, Foo&Bar $paramB): InterFaceName|false&InvalidIntersection {}
}

function namedFunction(?string|null &...$p, TypeA&namespace\TypeB $q): string|int {};

$closure = function (TypeA|TypeB $p, TypeA&namespace\TypeB $q): \Fully\Qualified&Partially\Qualified {};

$arrow = fn (TypeA|TypeB $p, TypeA&namespace\TypeB $q): string|int => $p * $q;

/*
 * Incorrect spacing.
 */
class IncorrectSpacing {

    public int | bool    |
       null $property;

    protected function foo(int | bool $paramA, Foo
    &
    Bar $paramB): InterFaceName /*comment*/ |  false /*comment */ &  InvalidIntersection {}
}

function namedFunction(?string  |  null &...$p, TypeA&  namespace\TypeB $q): string
  |int {};

$closure = function (TypeA      |       TypeB $p, TypeA  &namespace\TypeB $q): \Fully\Qualified & Partially\Qualified {};

$arrow = fn (TypeA | TypeB $p, TypeA &  namespace\TypeB $q): string  |  int => $p * $q;

// Live coding.
// This test should be the last test in the file.
function foo(int|
