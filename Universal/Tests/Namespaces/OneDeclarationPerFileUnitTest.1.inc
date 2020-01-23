<?php

// Multiple namespaces in one file without curly braces.

namespace Vendor\Project\FirstNamespace;

// Code ...

namespace Vendor\Project\SecondNamespace; // Error.

echo namespace\CONSTANT_NAME; // OK, namespace operator.

namespace Vendor\Project\ThirdNamespace; // Error.

$foo = namespace\function_call(); // OK, namespace operator.

namespace Vendor\Project\FourthNamespace; // Error.

// More code...

// Intentional parse error. Will be ignored.
namespace /* some comment */;
