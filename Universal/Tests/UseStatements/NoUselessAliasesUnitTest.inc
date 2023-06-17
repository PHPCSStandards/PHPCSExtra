<?php

// Ignore as not import use.
$closure = function () use ($bar) {
    return $bar;
};

class Foo {
    use MyNamespace\Bar;
}

// Ignore, no aliases.
use MyNamespace\MyClass;
use function MyNamespace\MyFunction;
use const MyNamespace\MyConst;

// Ignore, aliased to different name.
use MyNamespace\MyClass as YourClass;
use function MyNamespace\MyFunction as YourFunction;
use const MyNamespace\MyConst as YourConst;

// Ignore, constant aliased to same name, but different case.
use const MyNamespace\MyConst as MYCONST;

// These should be flagged.
use MyNamespace\NotAutoFixable /*comment*/ as NotAutoFixable;
use MyNamespace\NotAutoFixableEither
    as
    // phpcs:ignore Stnd.Cat.Sniff -- for reasons.
    notAutofixableEither;

use MyNamespace\MyClass as MyClass;
use MyNamespace\MyClass as MYCLASS;
use MyNamespace\MyClass as myclass;

use function MyNamespace\MyFunction as MyFunction;
use function MyNamespace\MyFunction
    as
    myfunction;

use const MyNamespace\MyConst as MyConst;

// Verify that the error is thrown on the correct token/line for multi and group use statements.
use function foo\math\sin,
    foo\math\cos as Cos, // Error.
    foo\math\cosh;

use some\namespacing\{
    SomeClassA as SomeOtherClass, // OK.
    deeper\level\SomeClassB,
    another\level\SomeClassC as SomeClassC // Error.
};

use const foo\math\PI,
    // Comment.
    foo\math\GOLDEN_RATIO as GOLDEN_RATIO;

use Some\NS\ {
   ClassName as className, // Error.
   function SubLevel\functionName as FunctionName, // Error.
   const Constants\MYCONSTANT as MYCONSTANT, // Error.
   const Constants\CONSTANT_NAME as Constant_Name, // OK.
};

// Verify handling of non-ascii names.
use Vendor\Package\Déjàvü as Dejavu; // OK.
use Vendor\Package\Déjàvü as DÉJÀVÜ; // Ok.
use Vendor\Package\Déjàvü as Déjàvü; // Error.
use Vendor\Package\Déjàvü as déJàVü; // Error.

use function 💩💩 as 💩; // OK.
use function 💩💩 as 💩💩; // Error.

// Verify handing with (illegal) duplicate aliases.
use function foo\math\sin as Cos, // OK.
    foo\math\cos as Cos; // Error.

// Intentional parse error.
use function as ;

// Intentional parse error.
// This has to be the last test in the file.
use MyNS\Level\{
    Something,
