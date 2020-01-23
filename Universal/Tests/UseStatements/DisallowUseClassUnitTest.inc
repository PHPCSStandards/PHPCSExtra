<?php

// Ignore, not class import.
use function MyNamespace\myFunction;
use const MyNamespace\YOUR_CONST as CONST_ALIAS;

// These should be flagged.
use My\NS\SomeClass;
use My\NS\SomeClass as OtherClass;

use Vendor\Foo\ClassA as ClassABC,
    Vendor\Bar\InterfaceB,
	Vendor\Bar\Bar, // Testing finding the correct line to report on.
    Vendor\Baz\ClassC;

use some\namespacing\{
    SomeClassA,
    deeper\level\SomeClassB,
    another\level\SomeClassC as C
};

// Mixed group use statement. Yes, this is allowed.
use Some\NS\{
    ClassName, // Error.
    function SubLevel\functionName,
    const Constants\CONSTANT_NAME as SOME_CONSTANT,
    function SubLevel\AnotherName,
    AnotherLevel, // Error.
};

// Ignore as not import use.
$closure = function() use($bar) {
    return $bar;
};

class Foo {
    use MyNamespace\Bar;
}
