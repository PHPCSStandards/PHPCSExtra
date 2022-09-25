<?php

/* Test the defaults (no braces/alternative syntax, all directives). */

declare(strict_types=1); // Ok.

declare(ticks=10); // Ok.

declare(encoding='ISO-8859-1'); // Ok.

declare(strict_types=1, encoding='ISO-8859-1'); // Ok.

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

declare(strict_types=1, ticks=10): // Error.
// Code.
enddeclare;

declare(ticks=1): // Error.
    declare(ticks=1): // Error.
    // Code.
    enddeclare;
enddeclare;

declare(encoding='ISO-8859-1', ticks=10): // Error.
    declare(ticks=1): // Error.
    // Code.
    enddeclare;
enddeclare;

/* Error if braces/alternative syntax are used. */

declare(ticks=1) { // Error.

}

declare(ticks=1) // Error.


{
// Code.


}

declare(ticks=1) // Error.
// Comment here.

{
// Code.


}

declare(ticks=1): // Error.
// Code.
enddeclare;

declare(encoding='ISO-8859-1', ticks=10): // Error.
// Code.
enddeclare;

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


/* Test the required braces/alternative syntax for all directives. */
// phpcs:set Universal.DeclareStatements.DeclareStatementsStyle declareStyle requireBraces

declare(ticks=1) { // Ok.

}

declare(ticks=1) // Ok.


{
// Code.


}

declare(ticks=1) // Ok.
// Comment here.

{
// Code.


}

declare(encoding='ISO-8859-1') { // Ok.

}

declare(encoding='ISO-8859-1') // Ok.


{
// Code.


}

declare(encoding='ISO-8859-1') // Ok.
// Comment here.

{
// Code.


}

declare(encoding='ISO-8859-1', ticks=1) { // Ok.

}

declare(encoding='ISO-8859-1', ticks=1) // Ok.


{
// Code.


}

declare(encoding='ISO-8859-1', ticks=1) // Ok.
// Comment here.

{
// Code.


}

/* Error if no braces are used (except for the strict_types). */

declare(strict_types=1); // Error.

declare(ticks=10); // Error.

declare(encoding='ISO-8859-1'); // Error.

declare(strict_types=1, encoding='ISO-8859-1'); // Error.

/* No error if alternative syntax is used. */

declare(ticks=1): // Ok.
// Code.
enddeclare;

declare(encoding='ISO-8859-1', ticks=10): // Ok.
// Code.
enddeclare;

declare(ticks=1): // Ok.
    declare(ticks=1): // Ok.
    // Code.
    enddeclare;
enddeclare;

declare(encoding='ISO-8859-1', ticks=10): // Ok.
    declare(ticks=1): // Ok.
    // Code.
    enddeclare;
enddeclare;

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

/* Test the required braces/alternative syntax for ticks only. */
// phpcs:set Universal.DeclareStatements.DeclareStatementsStyle declareStyle requireBraces
// phpcs:set Universal.DeclareStatements.DeclareStatementsStyle directiveType[] ticks

declare(ticks=1) { // Ok.

}

declare(ticks=1) // Ok.


{
// Code.


}

declare(ticks=1) // Ok.
// Comment here.

{
// Code.


}

declare(encoding='ISO-8859-1', ticks=10); // Error.

declare(encoding='ISO-8859-1', ticks=10): // Ok.
    declare(ticks=1): // Ok.
    // Code.
    enddeclare;
enddeclare;

/* Error if no braces are used for ticks. */

declare(ticks=100); // Error.

/* No error if alternative syntax is used with ticks. */

declare(ticks=1): // Ok.
    declare(ticks=1): // Ok.
    // Code.
    enddeclare;
enddeclare;

/* No error for any version of encoding usage. */

declare(encoding='ISO-8859-1'); // Ok.

declare(encoding='ISO-8859-1', ticks=1) // Ok.
// Comment here.

{
// Code.


}

declare(encoding='ISO-8859-1', ticks=1) { // Ok.

}

declare(encoding='ISO-8859-1', ticks=1) // Ok.


{
// Code.


}

declare(encoding='ISO-8859-1') // Ok.
// Comment here.

{
// Code.


}

declare(encoding='ISO-8859-1') { // Ok.

}

declare(encoding='ISO-8859-1') // Ok.


{
// Code.


}

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

/* Test the required braces/alternative syntax for encoding only. */
// phpcs:set Universal.DeclareStatements.DeclareStatementsStyle declareStyle requireBraces
// phpcs:set Universal.DeclareStatements.DeclareStatementsStyle directiveType[] encoding

declare(encoding='ISO-8859-1') { // Ok.

}

declare(encoding='ISO-8859-1') // Ok.


{
// Code.


}

declare(encoding='ISO-8859-1') // Ok.
// Comment here.

{
// Code.


}

declare(ticks=10, encoding='ISO-8859-1'); // Error.

declare(ticks=10, encoding='ISO-8859-1'): // Ok.
    declare(encoding='ISO-8859-1'): // Ok.
    // Code.
    enddeclare;
enddeclare;

/* Error if no braces are used for encoding. */

declare(encoding='ISO-8859-1'); // Error.

/* No error if alternative syntax is used with encoding. */

declare(encoding='ISO-8859-1'): // Ok.
    declare(encoding='ISO-8859-1'): // Ok.
    // Code.
    enddeclare;
enddeclare;

/* No error for any version of ticks usage. */

declare(ticks=10); // Ok.

declare(ticks=10, encoding='ISO-8859-1') // Ok.
// Comment here.

{
// Code.


}

declare(ticks=10, encoding='ISO-8859-1') { // Ok.

}

declare(ticks=10, encoding='ISO-8859-1') // Ok.


{
// Code.


}

declare(ticks=10) // Ok.
// Comment here.

{
// Code.


}

declare(ticks=10) { // Ok.

}

declare(ticks=10) // Ok.


{
// Code.


}

/* Throw errors if braces are used but also if some code is written before braces (unexpected code). */

declare(encoding='ISO-8859-1') // Error.
echo 'hi!';

{
// Code.


}

declare(ticks=10, encoding='ISO-8859-1') // Error.
echo 'hi!';

{
// Code.


}

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
