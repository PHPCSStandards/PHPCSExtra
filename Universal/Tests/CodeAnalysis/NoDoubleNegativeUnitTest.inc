<?php

/*
 * Not our targets.
 */

if (!$something) {}
if (!$something instanceof \Something) {}

$var = $a && ! $b;

/*
 * The issue.
 */

if (!!$something) {}

$var = $a && ! ! $b;
$var = $a && !!! $b;
$var = $a && ! ! ! ! $b;
$var = $a && !!!       !! $b;
$var = $a && !   	     /*comment*/      ! $b;

$var = !

/*comment*/

! $b;

$var = $a && ! /*c*/ ! /*c*/
// phpcs:ignore Stnd.Cat.SniffName
! $b;

$var = $a && ! /*c*/ ! /*c*/ !
// Comment
! $b;

/*
 * Make sure the operator precedence change doesn't cause a behavioural change in combination with instanceof.
 */

// If an instanceof is within parentheses, we're good.
if (!!($something instanceof \Something)) {}

$var = !!($something->prop instanceof Something);
$var = !!!($something->method() instanceof Something);
$var = !!!!($something['key']->my['key']->chained instanceof Something);

$var = !!(self::ENUM_SET_AS_CONSTANT instanceof \Something);
$var = !!(parent::ENUM_SET_AS_CONSTANT instanceof Something);
$var = !! (static::ENUM_SET_AS_CONSTANT instanceof \Something);

if (!!
   (function ($p) {
    return new $p;
})('dummy') instanceof Foo) {}

// If an instanceof is after another operator with lower precedence, we're good.
if (!!$something && $somethingElse instanceof \Something) {}
if (!!$something() || $somethingElse instanceof \Something) {}
if (!! $boolean !== $somethingElse instanceof Something) {}
while (!! $boolean = $somethingElse instanceof \Something) {}
if ( !  ! $boolean and $somethingElse instanceof \Something) {}
$var = !!$boolean ? $somethingElse instanceof Something : true;
$var = !!$boolean ?? $somethingElse instanceof \Something;

// Instanceof where the not does not apply to.
if (!!$something($somethingElse instanceof \Something)) {}
if (!!['key' => $somethingElse instanceof \Something]['key']) {}
if (!!$array[$somethingElse instanceof \Something ? 'keyA' : 'keyB']) {}
if (!!match($a) { 'foo' => $a instanceof Foo, 'bar' => $a instanceof Bar } === true) {}

// Note: this contains an intentional parse error, nothing to worry about.
if (!!
   #[\Attr(self::ENUM_SET_AS_CONSTANT instanceof Foo)]
   (function ($p) {
    return $p instanceof Foo;
})('dummy')) {}

// If it's an instanceof with triple not, we're good.
$var = !!!$something->method() instanceof \Something;

// Make the error non-autofixable when used in combination with instanceof without parentheses to avoid issues with precedence.
if(!!$something instanceof \Something) {}

$var = !!$something->prop instanceof \Something;

$var = !!self::ENUM_SET_AS_CONSTANT instanceof \Something;
$var = (!!parent::ENUM_SET_AS_CONSTANT instanceof \Something);
$var = !! static::ENUM_SET_AS_CONSTANT instanceof \Something;

$var = (!!!!$something['key']->my['key']->chained instanceof \Something);

$var = !!$something[$a + 1] instanceof \Something;
$var = !!$something[++$a] instanceof \Something;

$var = !!callMe($something[$a + 1]) instanceof \Something;
$var = !!new ClassA instanceof ('std' . 'Class');

if (!!match($a) { 'foo' => new Foo, 'bar' => new Bar } instanceof Bar) {}

// Intentional parse error/live coding.
// This needs to be the last test in the file.
if(!
