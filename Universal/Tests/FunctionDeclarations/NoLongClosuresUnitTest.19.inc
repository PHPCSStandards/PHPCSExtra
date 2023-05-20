<?php
// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreCommentLines false
// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreEmptyLines false
/*
 * OK.
 */
$closure = function() {
    line1();
};

    $closure = function() {
        // Comment.
        line2();
        // Comment.
        # Comment.
        line5();
    };

/*
 * Warning.
 */
$closure = function() {
    /*
     * Comment.
     */
    // Comment.
    /* Comment
     * Comment. */
};

        $closure = function() {
            // Comment.
            # Comment.
            line3();
            /* Comment.
               Comment. */
            line6();
            /**
             */
        };

/*
 * Error.
 */
    $closure = function() {
        // Comment.
        line2();
        /* Comment */
        line4();
        /** Comment */
        line6();
        // Comment.
        line8();
        # Comment
    };

$closure = function() {
    /**
     * Docblock
     *
     * Description.
     *
     * @tag
     *
     * @tag
     */
    line10();
    // Comment.
    // Comment.
    // Comment.
    // Comment.
    /* Comment.



       Comment. */
    line20();
};

// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreEmptyLines true
// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreCommentLines true
