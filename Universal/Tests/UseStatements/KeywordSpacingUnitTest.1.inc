<?php

/*
 * OK.
 */
// Ignore as not import use keywords.
$closure = function   () use   ($bar) {
    return $bar;
};

class Foo {
    use   MyNamespace\Bar;

    const   MY_CONST = 123;
    public function   foo() {}
}

const ABC = false;
function Foo() {}

foreach ($a   as   $k => $v) {}

// Ignore, spacing is already correct.
use Vendor\Package\Name as OtherName;
use function Vendor\Package\functionName as otherFunction;
use const Vendor\Package\CONSTANT_NAME as OTHER_CONSTANT;

use Vendor\Package\MultiStatement as Multi,
    DateTime as dateT;

use function Vendor\Package\MultiFunction as MFunction,
    strpos as pos;

USE Some\NS\ {
   ClassName As OtherClassName,
   Function SubLevel\functionName AS OtherFunctionName,
   CONST Constants\MYCONSTANT as OTHERCONSTANT,
};

// Ignore, "function", "const", "as" are used as part of a name (PHP 8.0+), not as the keyword.
use Vendor\Package\As\Name as Something;
use function Vendor\Function\Name as some_function;
use Vendor\Const\Name as CONSTANT_HANDLER;

/*
 * Error.
 */
use  Vendor\Package\Name  as  OtherName;
use

   Function

   Vendor\Package\functionName

   as

   otherFunction;
use FuncTion\Util\functionB;
use  CONST  Vendor\Package\CONSTANT_NAME   as  /*comment*/ OTHER_CONSTANT;
use Const\Util\MyClass\CONSTANT_Y;

use Vendor\Package\MultiStatement as   Multi,
    DateTime   AS   dateT;

Use  function   Vendor\Package\MultiFunction  as  MFunction,
    strpos  as  pos;

use   Some\NS\{
   ClassName
     // phpcs:ignore Stnd.Cat.Sniff --for reasons.
     as  OtherClassName,
   function/*comment*/  SubLevel\functionName
     as  OtherFunctionName,
   const   Constants\MYCONSTANT
     as  OTHERCONSTANT,
};

// Invalid code, but will still be handled.
use;
