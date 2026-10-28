<?php

// Intentional parse error (group use statement not closed, followed by a class).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

use Vendor\Package\{ClassA,

class Foo {}
