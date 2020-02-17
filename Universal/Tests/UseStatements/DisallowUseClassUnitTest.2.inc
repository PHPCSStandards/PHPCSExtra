<?php

/*
 * First namespace.
 */
namespace MyProject;

// Same namespace.
use MyProject\SomeClass;
use \myproject\SomeOtherClass as OtherClass; // Test leading backslash tolerance & case-insensitivity.

// Not the same namespace.
use Vendor\MyProject\ClassABC,
    MyProjectXYZ\ClassDEF;

// Another namespace.
use AnotherProject\Bar\Foo\InterfaceA,
    AnotherProject\Foo\Bar\ClassXYZ as FooBar,
    \AnotherProject\Foo\Bar\ClassKLM; // Test leading backslash tolerance.

// Global namespace.
use Reflection;


/*
 * Second namespace.
 */
namespace AnotherProject\Foo\Bar;

// Another namespace. Test against bleed through from first namespace.
use MyProject\SomeClass;
use \MyProject\SomeOtherClass as OtherClass; // Test leading backslash tolerance.

// Not the same namespace.
use Vendor\MyProject\ClassABC;

use AnotherProject\Bar\Foo\InterfaceA,
    // Same namespace.
    AnotherProject\Foo\Bar\ClassXYZ as FooBar,
    \AnotHerProJect\foo\BAR\ClassKLM; // Test leading backslash tolerance & case-insensitivity.

// Global namespace.
use \ReflectionClass; // Test leading backslash tolerance.
