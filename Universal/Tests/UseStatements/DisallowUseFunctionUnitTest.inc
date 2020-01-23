<?php

// Ignore, not function import.
use My\NS\SomeClass;
use const MyNamespace\YOUR_CONST as CONST_ALIAS;

// These should be flagged.
use function MyNamespace\myFunction;
use function Vendor\YourNamespace\yourFunction as FunctionAlias;

use function foo\math\sin,
    foo\math\cos as FooCos,
    foo\math\cosh;

use function bar\math\{
    Msin,
    level\Mcos as BarCos,
    Mcosh,
};

// Mixed group use statement. Yes, this is allowed.
use Some\NS\{
    ClassName,
    function SubLevel\functionName, // Error.
    const Constants\CONSTANT_NAME as SOME_CONSTANT,
    function SubLevel\AnotherName, // Error.
    AnotherLevel,
};

// Ignore as not import use.
$closure = function() use($bar) {
    return $bar;
};

class Foo {
    use MyNamespace\Bar;
}
