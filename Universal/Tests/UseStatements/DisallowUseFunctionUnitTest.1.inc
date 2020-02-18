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

// Test handling of alias as part of the last leaf of the imported name, including case-insensitivity
// and tolerance for leading backslashes.
// While aliasing to itself doesn't make much sense, the sniff should handle it correctly.
use function My\preg_match as Match;
use function My\preg_replace as Preg_Replace;
use function str_pos as Pos; // Alias for global import.
use function \str_pad as STR_PAD; // Alias for global import to same name.

// Test reporting on the correct line. Contrived example, but is valid PHP.
use function My
    \function_name
    \sub
    \function_name;

// Ignore as not import use.
$closure = function() use($bar) {
    return $bar;
};

class Foo {
    use MyNamespace\Bar;
}
