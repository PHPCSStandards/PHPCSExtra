<?php

/*
 * This is ok.
 */
if ( true && $true ) {
    echo 'True';
} elseif ($true || false) {
    echo 'False';
}

/*
 * Using Logical operators
 */
if ( true and $true ) {
    echo 'True';
} elseif ($true or true) {
    echo 'False';
}
