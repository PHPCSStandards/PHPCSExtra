<?php

// Ignore, not const import.
use My\NS\SomeClass;
use function Vendor\YourNamespace\yourFunction as FunctionAlias;

// These should be flagged.
use CONST MyNamespace\MY_CONST;
use const MyNamespace\YOUR_CONST as CONST_ALIAS;

use const foo\math\PI,
    foo\math\GOLDEN_RATIO as MATH_GOLDEN;

use const bar\math\{
    BGAMMA as BAR_GAMMA,
    BGOLDEN_RATIO
};

// Mixed group use statement. Yes, this is allowed.
use Some\NS\{
    ClassName,
    function SubLevel\functionName,
    const Constants\CONSTANT_NAME as SOME_CONSTANT, // Error.
    function SubLevel\AnotherName,
    AnotherLevel,
};

// Ignore as not import use.
$closure = function() use($bar) {
    return $bar;
};

class Foo {
    use MyNamespace\Bar;
}
