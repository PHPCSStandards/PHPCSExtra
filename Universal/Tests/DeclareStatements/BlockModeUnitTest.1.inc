<?php

/* Test the defaults: allow block mode for ticks, disallow for encoding and strict types. */

declare(strict_types=1); // Ok.

declare(ticks=10); // Ok.

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1) { // Ok.
    // Code.
}

declare(ticks=3): // Ok.
    // Code.
enddeclare;

/* Always error if `strict_types` use braces or alternative syntax (alone and with other directive). */

declare(strict_types=1) { // Error.

}

declare(strict_types=1, ticks=10) { // Error.

}

declare(strict_types=1) // Error.


{
// Code.


}

declare(strict_types=1) // Error.
// Comment here.

{
// Code.


}

declare(strict_types=1): // Error.
// Code.
enddeclare;

declare(strict_types=1, encoding='ISO-8859-1'): // Error.
// Code.
enddeclare;

declare(strict_types=1, encoding='ISO-8859-1'); // Error.
declare(strict_types=1, encoding='ISO-8859-1', ticks=10); // Error.

/* Throw errors if braces are used but also if some code is written before braces (unexpected code). */

declare(ticks=1) // Error.
echo 'hi!';

{
// Code.


}

declare(encoding='ISO-8859-1', ticks=10) // Error.
echo 'hi!';

{
// Code.


}

declare ticks=1; // Intentional live coding error. Ignore.
