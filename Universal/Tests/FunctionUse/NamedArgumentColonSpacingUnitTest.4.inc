<?php

// Intentional parse error (a named argument with no value, followed by another argument).
// This should be the only test in the file.
// Testing that the sniff is *not* triggered.

foo( nameA:  , nameB: 10 );
