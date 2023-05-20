<?php /* Both higher than default values */
// phpcs:set Universal.FunctionDeclarations.NoLongClosures recommendedLines 8
// phpcs:set Universal.FunctionDeclarations.NoLongClosures maxLines 15
/*
 * OK.
 */
$closure = function() {
    line1();
};

    $closure = function() {
        line1();
        line2();
        line3();
        line4();
        line5();
    };

/*
 * Warning.
 */
        $closure = function() {
            line1();
            line2();
            line3();
            line4();
            line5();
            line6();
        };

$closure = function() {
echo
2
+
4
+
6
-
8
};

/*
 * Error.
 */
    $closure = function() {
        line1();
        line2();
        line3();
        line4();
        line5();
        line6();
        line7();
        line8();
        line9();
    };

$closure = function() {
    line1();
    line2();
    line3();
    line4();
    line5();
    line6();
    line7();
    line8();
    line9();
    line10();
    line11();
    line12();
    line13();
    line14();
    line15();
    line16();
    line17();
    line18();
    line19();
    line20();
};

// phpcs:set Universal.FunctionDeclarations.NoLongClosures recommendedLines 5
// phpcs:set Universal.FunctionDeclarations.NoLongClosures maxLines 8
