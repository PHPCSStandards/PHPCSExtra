<?php

// Intentional parse error (group use statement not closed before the semicolon).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

namespace Foo {
    use Vendor\Package\{ClassA, ClassB;
}
