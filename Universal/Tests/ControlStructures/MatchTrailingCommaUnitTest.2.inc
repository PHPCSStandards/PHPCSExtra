<?php

// Intentional parse error (match expression only containing a comma).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

$r = match ($x) {,};
