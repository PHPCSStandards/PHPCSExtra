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

// Test handling of alias as part of the last leaf of the imported name, including case-insensitivity.
// While aliasing to itself doesn't make much sense, the sniff should handle it correctly.
use const My\PHP_MINOR_VERSION as Minor_version;
use const My\PHP_MAJOR_VERSION as Php_Major_Version;
use const PHP_VERSION_ID as version_id; // Alias for global import.
use const PHP_VERSION as php_version; // Alias for global import to same name.

// Ignore as not import use.
$closure = function() use($bar) {
    return $bar;
};

class Foo {
    use MyNamespace\Bar;
}
