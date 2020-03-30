<?php

$long = $compare ? 'a' : 'b';

$short = isset($a) ? : 0; // Bad.
$short = !empty($b) ?: !empty($c) ?: 0; // Bad.
$short = $compare ? /* intentionally left empty */
    : 0; // Bad.

/* Intentional parse error. This should be the last test in the file. */
$unfinished = $compare ? /* comment */
