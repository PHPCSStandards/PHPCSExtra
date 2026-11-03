<?php

// Intentional parse error (enum case keyword followed by a non-name token).
// This should be the only test in the file.

enum Incomplete {
    case ;
}
