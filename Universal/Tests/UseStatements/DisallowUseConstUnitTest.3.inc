<?php

/*
 * First (scoped) namespace.
 */
namespace MyProject {

    // Same namespace.
    use Const MyProject\MY_CONST;
    use const \myproject\YOUR_CONST as CONST_ALIAS; // Test leading backslash tolerance & case-insensitivity.

    // Not the same namespace.
    use const Vendor\MyProject\PIP;
    use const MyProjectXYZ\RATIO;

    // Another namespace.
    use const foo\math\PI,
        \foo\math\GOLDEN_RATIO as MATH_GOLDEN; // Test leading backslash tolerance.

    // Global namespace.
    use const PHP_VERSION_ID;
}

/*
 * Second (scoped) namespace - no name.
 */
namespace {

    // Another namespace. Test against bleed through from first namespace.
    use const MyProject\MY_CONST;
    use const MyProject\YOUR_CONST as CONST_ALIAS;

    // Not the same namespace.
    use const Vendor\MyProject\PIP;

    use const AnotherProject\Bar\Foo\functionName,
        AnotherProject\Foo\Bar\functionName as FooCos,
        \AnotHerProJect\foo\BAR\functionDecl; // Test leading backslash tolerance.

    // Global namespace.
    use const \PHP_MAJOR_VERSION; // Test leading backslash tolerance.
}

/*
 * Third (scoped) namespace.
 */
namespace AnotherProject\Foo\Bar {

    // Another namespace.
    use CONST MyProject\MY_CONST;
    use const \MyProject\YOUR_CONST as CONST_ALIAS; // Test leading backslash tolerance.

    // Not the same namespace.
    use const Vendor\AnotherProject\PIP;

    // Same namespace.
    use const AnotherProject\Foo\Bar\PI,
        \AnotHerProJect\foo\BAR\GOLDEN_RATIO as MATH_GOLDEN; // Test leading backslash tolerance & case-insensitivity.

    // Global namespace.
    use const PHP_VERSION;
}

// Will throw an error as if it is still within the `AnotherProject` scoped namespace.
// As this is a parse error anyway, as no code is allowed outside of the namespace brackets,
// this is not something we should be concerned about.
use const AnotherProject\Foo\Bar\DIDDLE;
