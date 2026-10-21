<?php

/* Always error if `strict_types` use braces or alternative syntax (with other directives). */
// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode require
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode require

declare(strict_types=1, encoding='ISO-8859-1'): // Error.
    // Code.
enddeclare;

declare(strict_types=1, ticks=10) { // Error.
    // Code.
}

declare(encoding='ISO-8859-1', ticks=10) { // Ok.
    // Code.
}

declare(strict_types=1, encoding='ISO-8859-1'): // Error.
    declare(strict_types=1, ticks=1): // Error.
        declare(encoding='ISO-8859-1', ticks=1): // Ok.
            // Code.
        enddeclare;
    enddeclare;
enddeclare;

/* Error if multiple directives are used, and one explicitly disallows block mode. */
// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode require

declare(encoding='ISO-8859-1', ticks=10) { // Error.
    // Code.
}

// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode allow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode disallow

declare(encoding='ISO-8859-1', ticks=10) { // Error.
    // Code.
}

declare(strict_types=1, encoding='ISO-8859-1'): // Error.
    declare(strict_types=1, ticks=1): // Error.
        // Code.
    enddeclare;
enddeclare;

/* Reset to the default directives for the next run */
// phpcs:set Universal.DeclareStatements.BlockMode encodingBlockMode disallow
// phpcs:set Universal.DeclareStatements.BlockMode ticksBlockMode allow
