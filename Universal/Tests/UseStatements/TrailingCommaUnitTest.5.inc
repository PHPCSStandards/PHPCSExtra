<?php

// Intentional parse error (empty group use statement).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

use Vendor\Package\{
};
