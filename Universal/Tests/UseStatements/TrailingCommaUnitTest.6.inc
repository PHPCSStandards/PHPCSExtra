<?php

// Intentional parse error (group use statement only containing a comma).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

use Vendor\Package\{,};
