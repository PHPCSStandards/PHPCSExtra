<?php

/*
 * Valid namespace declaration(s).
 */
namespace Vendor\ValidDeclaration;

echo namespace\ClassName::$property; // Ok, not namespace declaration.

// Intentional parse error. This has to be the last test in the file.
namespace
