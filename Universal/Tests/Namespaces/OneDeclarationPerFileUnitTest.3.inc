<?php

// One declaration in the file.
// Also tests that there is no cross-file bleed-through.

namespace Vendor\Project\ValidDeclaration;

echo namespace\ClassName::$property; // Ok, not namespace declaration.

// Intentional parse error. This has to be the last test in the file.
namespace
