<?php

// Intentional parse error.
// This must be the only test in the file.
// This code sniff should **not** be flagged as we cannot determine for certain whether this is a first class callable or not.
callable(  ...
