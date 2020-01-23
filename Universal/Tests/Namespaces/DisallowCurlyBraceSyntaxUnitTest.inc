<?php

namespace Vendor\Project\ValidDeclaration;

echo namespace\ClassName::$property; // OK. Namespace operator, not namespace declaration.

namespace {} // Error.

namespace Vendor\Project\NamedScopedNamespace { // Error.
    // Code
    $foo = namespace\function_call(); // OK. Namespace operator, not namespace declaration.
}

namespace /* some comment */ {} // Error.

// Intentional parse error. This has to be the last test in the file.
namespace
