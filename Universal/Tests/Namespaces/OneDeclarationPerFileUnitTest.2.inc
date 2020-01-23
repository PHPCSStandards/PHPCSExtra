<?php

// Multiple namespaces in one file using curly braces.

namespace Vendor\Project\FirstNamespace {

    // Code ...
}

namespace Vendor\Project\SecondNamespace { // Error.

    echo namespace\CONSTANT_NAME; // OK, namespace operator.
}

namespace /* some comment */ { // Error.

    // More code...
}

namespace Vendor\Project\FourthNamespace { // Error.

    $foo = namespace\function_call(); // OK, namespace operator.
}

// Intentional parse error.
namespace {
