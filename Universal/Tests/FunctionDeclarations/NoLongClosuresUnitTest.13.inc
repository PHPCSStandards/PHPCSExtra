<?php
// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreCommentLines false

/*
 * OK.
 */
$closure = function() {
    line1();
};

    $closure = function() {

        line2();
        // Comment.
        line4();

    };

/*
 * Warning.
 */
$closure = function() {
    // Comment.
    # Comment.

    /* Comment */


};

        $closure = function() {

            # Comment.
            line3();

            /*
             * Comment
             */
            line8();
        };

/*
 * Error.
 */
$closure = function() {
    // Comment
    line2();

    /* Comment */
    line5();

    # Comment.
    line8();

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









        line20();
    };

// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreCommentLines true
