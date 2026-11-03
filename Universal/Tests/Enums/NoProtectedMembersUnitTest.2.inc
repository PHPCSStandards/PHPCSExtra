<?php

// Intentional parse error (close tag between the const keyword and the constant name).
// This should be the only test in the file.

enum ParseError {
    protected const ?><?php Y = 1;
}
