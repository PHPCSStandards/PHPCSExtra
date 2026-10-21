<?php

/* With weird syntax to verify the parsing, and nested alternative syntaxes. */

/* With ticks set to allow (default behavior). */

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode allow
declare(encoding='ISO-8859-1') // Ok.
// Comment here.


{
    // Code.
}

declare( // Ok.
    encoding=
    'ISO-8859-1'
):
    //Code.
enddeclare;

declare( // Ok.



    encoding


    =
    'ISO-8859-1'

);

declare( // Ok.
    ticks=
    1
);

declare(ticks=1): // Ok.
    declare(encoding='utf-8'): // Ok.
        // Code.
    enddeclare;
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
declare(encoding='ISO-8859-1') { // Error.
    // Code.
}

declare(encoding='ISO-8859-1'): // Error.
    declare(encoding='utf-8'): // Error.
        // Code.
    enddeclare;
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Ok.

declare(ticks=1): // Ok.
    declare(encoding='utf-8'): // Error.
        // Code.
    enddeclare;
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode require
declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    declare(encoding='utf-8'): // Ok.
        // Code.
    enddeclare;
enddeclare;

declare( // Error.
    encoding='ISO-8859-1'


);

/* With ticks set to disallow. */

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode allow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode disallow

declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    declare(encoding='ISO-8859-1'): // Ok.
    //Code.
    enddeclare;
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Ok.

declare(ticks=1): // Error.
    declare(encoding='ISO-8859-1'): // Ok.
    //Code.
    enddeclare;
enddeclare;

declare(ticks=1) // Error.
// Comment.
{
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode disallow

declare(encoding // Error.



='ISO-8859-1') {
    // Code.
}

declare(encoding='ISO-8859-1'): // Error.
    declare(ticks=1): // Error.
        //Code.
    enddeclare;
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Ok.

declare(ticks=1): // Error.
    //Code.
enddeclare;

declare( // Error.

    ticks
    =
    1
)



{
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode require
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode disallow

declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    //Code.
enddeclare;

declare(encoding= // Error.




'ISO-8859-1');

declare(ticks=1); // Ok.

declare( // Error.
    ticks=1

):
    declare(ticks=1): // Error.
        declare(encoding='ISO-8859-1'): // Ok.
            //Code.
        enddeclare;
    enddeclare;
enddeclare;

declare(ticks=1) { // Error.
    // Code.
}

/* With ticks set to require. */

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode allow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode require

declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    declare(encoding='ISO-8859-1'): // Ok.
        //Code.
    enddeclare;
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1) // Error.
// Comment.

;

declare(ticks=1): // Ok.
    //Code.
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode require

declare(encoding='ISO-8859-1') // Error.





{
    // Code.
}

declare(encoding='ISO-8859-1'): // Error.
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare( ticks = 1 ); // Error.

declare(ticks=1): // Ok.
    declare(encoding='ISO-8859-1'): // Error.
        //Code.
    enddeclare;
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode require
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode require

declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    //Code.
enddeclare;

declare( // Error.
    encoding
    =
    'ISO-8859-1'


);

declare(ticks=1 // Error.


);

declare( // Error.
    encoding
    =
    'ISO-8859-1', ticks=1


);

declare(ticks=1): // Ok.
    declare(encoding='ISO-8859-1'): // Ok.
        //Code.
    enddeclare;
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

/* Reset to the default directives for the next run */
// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode allow
