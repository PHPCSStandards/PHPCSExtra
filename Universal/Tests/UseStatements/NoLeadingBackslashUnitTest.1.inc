<?php

// Import use statements.
use Util\MyClass;
use \Util\MyOtherClass;

use function Util\functionA;
use FUNCTION \Util\functionB as functionC;

use const Util\MyClass\CONSTANT_X;
use Const\Util\MyClass\CONSTANT_Y;

use Vendor\Foo\ClassA as ClassABC,
    /*comment*/ \Vendor\Bar\InterfaceB,
    Vendor\Baz\ClassC as C_Class,
    \Vendor\Baz\ClassD ?>

<?php

use \some\namespacing\{
    \SomeClassA, // Intentional parse error. Should be ignored.
    function \another\level\function_name as my_function, // Intentional parse error. Should be ignored.
    const \another\level\CONSTANT_NAME, // Intentional parse error. Should be ignored.
};

// Not the use statements we're looking for.
class ClassUsingTrait {
    use \SomeTrait;
    use AnotherTrait;
}

$closure = function($param) use ($var) {};
