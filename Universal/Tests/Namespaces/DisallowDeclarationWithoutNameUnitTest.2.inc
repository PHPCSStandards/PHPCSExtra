<?php

/*
 * Invalid (no name) namespace declarations.
 */
namespace {}

namespace /* some comment */ {}

// Intentional parse error. Ignore. Non-named namespace declarations must have curly braces.
namespace /* some comment */;
