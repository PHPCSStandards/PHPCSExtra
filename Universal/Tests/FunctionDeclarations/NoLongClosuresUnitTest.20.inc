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




            line5();
        };

/*
 * Warning.
 */
    $closure = function() {






    };

$closure = function() {


    line3();


    line6();


};

/*
 * Error.
 */
        $closure = function() {

            line2();

            line4();

            line6();

            line8();

        };

$closure = function() {









    line10();









    line20();
};

// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreEmptyLines true
// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreCommentLines true
