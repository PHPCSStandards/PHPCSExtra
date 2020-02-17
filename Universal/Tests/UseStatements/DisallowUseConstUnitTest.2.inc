<?php

/*
 * First namespace.
 */
namespace MyProject;

// Same namespace.
use CONST MyProject\MY_CONST;
use const \MYProJect\YOUR_CONST as CONST_ALIAS; // Test leading backslash tolerance & case-insensitivity.

// Not the same namespace.
use const Vendor\MyProject\PIP;
use const MyProjectXYZ\RATIO;

// Another namespace.
use const foo\math\PI,
    \foo\math\GOLDEN_RATIO as MATH_GOLDEN; // Test leading backslash tolerance.

// Global namespace.
use const PHP_VERSION_ID;

/*
 * Second namespace.
 */
namespace foo\math;

// Another namespace. Test against bleed through from first namespace.
use CONST MyProject\MY_CONST;
use const \MyProject\YOUR_CONST as CONST_ALIAS; // Test leading backslash tolerance.

// Not the same namespace.
use const Vendor\MyProject\PIP;

// Same namespace.
use const foo\math\PI,
    \FOO\Math\GOLDEN_RATIO as MATH_GOLDEN; // Test leading backslash tolerance & case-insensitivity.

// Global namespace.
use const \PHP_VERSION; // Test leading backslash tolerance.
