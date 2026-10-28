<?php

// Intentional parse error (group use statement not closed, followed by another group use statement).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

use Vendor\Package\{ClassA,
use Other\Package\{ClassB, ClassC};
