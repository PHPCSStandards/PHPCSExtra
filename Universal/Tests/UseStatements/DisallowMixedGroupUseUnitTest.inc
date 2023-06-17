<?php

// Ignore as not import use.
$closure = function() use($bar) {
    return $bar;
};

class Foo {
    use MyNamespace\Bar;
}

// Ignore, not group use statements.
use My\NS\SomeClass;
use My\NS\SomeClass as OtherClass;
use function MyNamespace\myFunction;
use const MyNamespace\YOUR_CONST as CONST_ALIAS;

use Vendor\Foo\ClassA as ClassABC,
    Vendor\Bar\InterfaceB,
    Vendor\Baz\ClassC;

use function foo\math\sin, foo\math\cos as FooCos, foo\math\cosh;

// Ignore, single type group use statements.
use FooLibrary\Bar\Baz\{ ClassA, ClassB, ClassC, ClassD as Fizbo };

use some\namespacing\{
    SomeClassA,
    deeper\level\SomeClassB,
    another\level\SomeClassC as C
};

use function bar\math\{
    Msin,
    level\Mcos as BarCos,
    Mcosh,
};

use function foo\math\{ sin, cos, cosh };

use const
        bar\math\{ BGAMMA as BAR_GAMMA, BGOLDEN_RATIO };

/*
 * Mixed group use statements. These should be flagged.
 */
use WithComments\NonAutoFixable\{
    // Comment.
    ClassName,
    # Comment.
    function foo
};

use WithAnnotation\NonAutoFixable\{
    // phpcs:ignore Stnd.Cat.SniffName -- for reasons.
    ClassName,
    // phpcs:ignore Stnd.Cat.SniffName -- for reasons.
    function foo
};

// Blank lines within will be ignored/removed by the fixer.
use SingleLevel\ {
    ClassName,

    function SubLevel\functionName,
    const Constants\CONSTANT_NAME as SOME_CONSTANT,

    const Constants\MY_CONSTANT,
    function SubLevel\AnotherName,
    AnotherLevel,
};

            use Multi\Level\{
                ClassName,
                function SubLevel\functionName,
                const Constants\CONSTANT_NAME as SOME_CONSTANT,
                const Constants\MY_CONSTANT,
                function SubLevel\AnotherName,
                AnotherLevel
            };

// Note: alias for "ClassName as ClassName" will be removed.
use Triple\Sub\Level\{
    ClassName as ClassName,
    function SubLevel\functionName,
    const Constants\CONSTANT_NAME as SOME_CONSTANT,
    function SubLevel\AnotherName,
    const Constants\MY_CONSTANT,
    AnotherLevel,
} ?>
<?php
	// Deliberate use of tab indentation for testing purposes!
	use Two\Types\A\{
		ClassName,
		function SubLevel\functionName,
		function SubLevel\AnotherName as notherName,
		AnotherLevel
	};

use Two\Types\B\{
    ClassName,
    const Constants\CONSTANT_NAME as SOME_CONSTANT,
    const Constants\MY_CONSTANT,
    AnotherLevel,
};

use Two\Types\C\{
    function SubLevel\functionName,
    const Constants\CONSTANT_NAME as SOME_CONSTANT,
    function SubLevel\AnotherName,
};

use One\OfEach\{
    ClassName,
    function SubLevel\functionName,
    const Constants\CONSTANT_NAME as SOME_CONSTANT,
};


// Intentional parse error.
// This has to be the last test in the file.
use MyNS\Level\{
    Something,
