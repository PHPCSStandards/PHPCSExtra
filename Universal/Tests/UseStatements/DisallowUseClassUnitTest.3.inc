<?php

/*
 * First (scoped) namespace.
 */
namespace MyProject {

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
}

/*
 * Second (scoped) namespace - no name.
 */
namespace {

    // Another namespace. Test against bleed through from first namespace.
    use MyProject\SomeClass;
    use \MyProject\SomeOtherClass as OtherClass; // Test leading backslash tolerance.

    // Not the same namespace.
    use Vendor\MyProject\ClassABC;

    use AnotherProject\Bar\Foo\InterfaceA as FooBar,
        \AnotherProject\Foo\Bar\ClassKLM; // Test leading backslash tolerance.

    // Global namespace.
    use \ReflectionType; // Test leading backslash tolerance.
}

/*
 * Third (scoped) namespace.
 */
namespace AnotherProject\Foo\Bar {

    // Another namespace.
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
}

// Will throw an error as if it is still within the `AnotherProject` scoped namespace.
// As this is a parse error anyway, as no code is allowed outside of the namespace brackets,
// this is not something we should be concerned about.
use AnotherProject\Foo\Bar\RandomClass;
