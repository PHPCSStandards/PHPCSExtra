<?php

// Intentional parse error (constant declared without a value).
// This should be the only test in the file.

enum ParseError {
    protected const NO_VALUE;
}
