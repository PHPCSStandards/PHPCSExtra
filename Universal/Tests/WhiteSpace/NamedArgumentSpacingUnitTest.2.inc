<?php

// Intentional parse error (the named argument has no value and the next token starts a separate statement).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

foo(name:
$x = 1;
