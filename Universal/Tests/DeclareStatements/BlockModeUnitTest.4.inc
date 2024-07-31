<?php

/* With ticks set to allow (default behavior). */

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode allow
declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Ok.

declare(ticks=1): // Ok.
    //Code.
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
declare(encoding='ISO-8859-1') { // Error.
    // Code.
}

declare(encoding='ISO-8859-1'): // Error.
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Ok.

declare(ticks=1): // Ok.
    //Code.
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode require
declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Error.

/* With ticks set to disallow. */

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode allow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode disallow

declare(encoding='ISO-8859-1') { // Ok.
    // Code.
}

declare(encoding='ISO-8859-1'): // Ok.
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Ok.

declare(ticks=1): // Error.
    //Code.
enddeclare;

declare(ticks=1) { // Error.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode disallow

declare(encoding='ISO-8859-1') { // Error.
    // Code.
}

declare(encoding='ISO-8859-1'): // Error.
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Ok.

declare(ticks=1): // Error.
    //Code.
enddeclare;

declare(ticks=1) { // Error.
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

declare(encoding='ISO-8859-1'); // Error.

declare(ticks=1); // Ok.

declare(ticks=1): // Error.
    //Code.
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
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Error.

declare(ticks=1): // Ok.
    //Code.
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode require

declare(encoding='ISO-8859-1') { // Error.
    // Code.
}

declare(encoding='ISO-8859-1'): // Error.
    //Code.
enddeclare;

declare(encoding='ISO-8859-1'); // Ok.

declare(ticks=1); // Error.

declare(ticks=1): // Ok.
    //Code.
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

declare(encoding='ISO-8859-1'); // Error.

declare(ticks=1); // Error.

declare(ticks=1): // Ok.
    //Code.
enddeclare;

declare(ticks=1) { // Ok.
    // Code.
}

declare(ticks=1): // Ok.
    declare(ticks=1): // Ok.
    // Code.
    enddeclare;
enddeclare;

/* Reset to the default directives for the next run */
// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode allow
