<?php

/*
 * This is ok.
 */
if ( true === $true ) {
    echo 'True';
} elseif ($true!==false) {
    echo 'False';
}

/*
 * Loose comparisons.
 */
if ( true != $true ) {
    echo 'True';
} elseif ($true <> true) {
    echo 'False';
}

if ($true==true) {
    echo 'True';
}
