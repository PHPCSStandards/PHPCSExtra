<?php

// Intentional parse error (named argument with no value before the closing parenthesis).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

foo(name:);
