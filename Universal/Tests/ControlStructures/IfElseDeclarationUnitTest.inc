<?php

/*
 * Alternative control structure syntax. Ignore.
 */
if (true):
    // Code.
elseif (false):
    // Code.
else:
    // Code.
endif;

/*
 * Control structure without braces. Ignore.
 */
if (true)
    function_call($a); elseif (false)
    function_call($a); else
    function_call($a);

/*
 * OK: else/elseif on the next line.
 */
if ( true ) {
    // Code.
}
elseif {
    // Code.
}
else if {
    // Code.
}
else {
    // Code.
}

/*
 * OK: Comments and additional blank lines between the structures allowed.
 */

if ( true ) {
    // Code.
}
// Some comment - this comment should be ignored.
else {
    // Code.
}

if ( true ) {
    // Code.
} // Trailing comment.

/* phpcs:ignore Standard.Category.Sniffname -- for reasons. */
else {
    // Code.
}

// OK - multiple blank lines between if/else are ignored, not the concern of this sniff.
if ( true ) {
    // Code.
}


else {
    // Code.
}


/*
 * Error: else/elseif should be on the next line.
 *
 * We're not concerned with `else if` vs  elseif` or whether the keywords are on the same line
 * if `else if` is used. That's the concern of a sniff checking the keyword.
 */

if ( true ) {
    // Code.
} else { // Error.
    // Code.
}

if ( true ) {
    // Code.
} elseif( 1 ) { // Error.
    // Code.
} else if       (2 // Error.
    || 6
) {
    // Code.
} else // Error.
    if (2) {
    // Code.
} /* comment */ elseif (3) { // Error, non-autofixable as it's unclear where the comment should go.
    // Code.
} else { // Error.
    // Code.
}

/*
 * Test fixer for combined errors
 */

    // Test fixer with indentation.
    if ( true ) {
        // Code.
    } else { // Error.
        // Code.
    }

        if ( true ) {
            // Code.
        } elseif( 1 ) { // Error.
            // Code.
        } else if (2 // Error.
            && 5
        ) {
            // Code.
        } else( 3 ) { // Error.
            // Code.
        }

            // Test fixer with tokens other than whitespace indentation on the line with the previous if.
/*test*/    if ( true ) {
                // Code.
            } else { // Error.
                // Code.
            }

    // Test fixer with single-line control structure.
    if ( $a === 1 ) { echo $a; } elseif ( $a === 2 ) { echo $b; } else { echo $c; } // Error x 2.

// Live coding.
// Intentional parse error. This test has to be the last in the file.
    if ($a) {
        // Code.
    } else {
        // Code.
