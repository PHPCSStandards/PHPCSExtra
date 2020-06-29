<?php

// Class import use statements.
use Util\MyClass;
use \Util\MyOtherClass;

// Function/const import use statements.
use function Util\functionA;
use FuncTion\Util\functionB;
use FUNCTION \Util\functionC;

use const Util\MyClass\CONSTANT_X;
use Const\Util\MyClass\CONSTANT_Y;
use CONST Util\MyClass\CONSTANT_Z;

use \some\namespacing\{
    Function another\level\function_name,
    SomeClassA,
    Const another\level\CONSTANT_NAME,
};

// Not the use statements we're looking for.
class ClassUsingTrait {
    use \SomeTrait;
    use AnotherTrait;
}

$closure = function($param) use ($var) {};

// Not the const/function keywords we're looking for.
const ABC = false;
function Foo() {}
