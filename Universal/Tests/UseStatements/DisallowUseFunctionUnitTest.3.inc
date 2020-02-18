<?php

/*
 * First (scoped) namespace.
 */
namespace MyProject {

    // Same namespace.
    use function MyProject\myFunction;
    use function \myproject\Sub\yourFunction as FunctionAlias; // Test leading backslash tolerance & case-insensitivity.

    // Not the same namespace.
    use function Vendor\MyProject\myOtherFunction;
    use function MyProjectXYZ\myRelatedFunction;

    // Another namespace.
    use function AnotherProject\Bar\Foo\functionName,
        AnotherProject\Foo\Bar\functionName as FooCos,
        \AnotherProject\Foo\Bar\functionDecl; // Test leading backslash tolerance.

    // Global namespace.
    use function preg_match;
}

/*
 * Second (scoped) namespace - no name.
 */
namespace {

    // Another namespace. Test against bleed through from first namespace.
    use function MyProject\myFunction;
    use function \MyProject\yourFunction as FunctionAlias; // Test leading backslash tolerance.

    // Not the same namespace.
    use function Vendor\MyProject\myOtherFunction;

    use function AnotherProject\Bar\Foo\functionName,
        AnotherProject\Foo\Bar\functionName as FooCos,
        \AnotHerProJect\foo\BAR\functionDecl; // Test leading backslash tolerance.

    // Global namespace.
    use function \str_pos; // Test leading backslash tolerance.
}

/*
 * Third (scoped) namespace.
 */
namespace AnotherProject\Foo\Bar {

    // Another namespace.
    use function MyProject\myFunction;
    use function \MyProject\yourFunction as FunctionAlias; // Test leading backslash tolerance.

    // Not the same namespace.
    use function Vendor\AnotherProject\myOtherFunction;

    use function AnotherProject\Bar\Foo\functionName,
        // Same namespace.
        AnotherProject\Foo\Bar\functionName as FooCos,
        \AnotHerProJect\foo\BAR\functionDecl; // Test leading backslash tolerance & case-insensitivity.

    // Global namespace.
    use function preg_replace;
}

// Will throw an error as if it is still within the `AnotherProject` scoped namespace.
// As this is a parse error anyway, as no code is allowed outside of the namespace brackets,
// this is not something we should be concerned about.
use function AnotherProject\Foo\Bar\someFunction;
