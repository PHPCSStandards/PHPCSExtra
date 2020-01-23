<?php

namespace Vendor\Project\NamedScopedNamespace { // OK.
    // Code
    $foo = namespace\function_call(); // OK. Namespace operator, not namespace declaration.
}

echo namespace\ClassName::$property; // OK. Namespace operator, not namespace declaration.

namespace Vendor\Project\ /* comment*/ ValidDeclaration; // Error.

namespace Vendor; // Error.

// Intentional parse error. This has to be the last test in the file.
namespace
