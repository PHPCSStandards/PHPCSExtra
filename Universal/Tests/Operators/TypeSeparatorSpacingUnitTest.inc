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

/*
 * PHP 8.2 DNF types.
 */
class DNFTypes {
    private const (A&B)|false DNF_CORRECT_START = false;
    protected const false|(A&B) DNF_CORRECT_END = false;
    public const   ( A&B ) |false DNF_INCORRECT_START = false;
    final const false|   ( A&B )  DNF_INCORRECT_END = false;

    private (A&B)|false $dnfCorrectStart = false;
    readonly false|(A&B) $dnfCorrectEnd = false;
    static   ( A&B ) |false $dnfIncorrectStart = false;
    final false|   ( A&B )  $dnfIncorrectEnd = false;

    public function DNFCorrect(
        (A&B)|false $paramA, (A&B)|false $paramB,
        null|(\FQN&\Partially\Qualified) $paramC,
    ): (A&B)|(C&D) {
    }

    public function DNFIncorrect(
        (  A&B  )  |  false $paramA,  (A&B) |false $paramB,
        null| ( \FQN&\Partially\Qualified )
           $paramC,
    ):   ( A &B )
         |
         ( C&D  )   {
    }

    public function DNFIncorrectReturnTypeNoSpace():(A&B)|(C&D){}
}

// Live coding.
// This test should be the last test in the file.
function foo(int|
