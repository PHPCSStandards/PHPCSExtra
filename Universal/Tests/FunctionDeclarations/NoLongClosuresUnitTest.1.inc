<?php

/*
 * Verify line counting.
 */
$closure = function() {};
$closure = function() {              };
$closure = function() {   /* todo */   }; // OK, should count as 0 code, 0 comment line as comments is seen as trailing comment for opener.
$closure = function($a) { return $a * $a; }; // OK, should count as 1 code line.

$closure = function($a) { return $a * $a;
}; // OK, should count as 1 code line.

$closure = function($a) {
    return $a * $a; }; // OK, should count as 1 code line.

$closure = function($a) {
    return $a * $a;
    /* This comment should potentially be counted */ };


// OK: we are looking for lines, not statements.
$closure = function() { line1(); line2(); line3(); line4(); line5(); line6(); };

$closure = function($a, $b) {
    $b = $a; return $a * $a;
};


/*
 * Deal with code/comments on the lines of the scope opener/closer.
 */

$closure = function() {
    line1(); // Trailing comments should not influence the line count.
    line2();
    line3();
    line4(); // Trailing comments should not influence the line count.
    line5 /* Inline comments should not influence the line count. */ ();
}; // OK.

$closure = function() { line1();
    line2();
    line3();
    line4();
    line5();
    line6();
}; // Warning, code on scope opener line should be counted.

$closure = function() {
    line1();
    line2();
    line3();
    line4();
    line5();
    line6(); }; // Warning, code on scope closer line should be counted.

$closure = function() { line1();
    line2();
    line3();
    line4();
    line5();
    line6(); }; // Warning, code on scope opener + closer line should be counted.

// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreCommentLines false

$closure = function() { // Trailing comment on scope opener line should be ignored.
    line1();
    line2();
    line3();
    line4();
    line5();
}; // OK.

$closure = function() { // phpcs:ignore Standard.Cat -- Trailing comment on scope opener line should be ignored.
    line1();
    line2();
    line3();
    line4();
    line5();
}; // OK.

$closure = function() {
    line1();
    line2();
    line3();
    line4();
    line5();
/* comment */ }; // Warning. Leading comment on scope closer line should be counted.

$closure = function() {
    line1();
    line2();
    line3();
    line4();
    line5();
/* phpcs:ignore Standard.Cat */ }; // Warning. Leading comment on scope closer line should be counted.

// phpcs:set Universal.FunctionDeclarations.NoLongClosures ignoreCommentLines true

// phpcs:set Universal.FunctionDeclarations.NoLongClosures maxLines false
$closure = function($a) { return $a * $a; }; // Error, invalid maxLines setting, evaluates to 0.

// phpcs:set Universal.FunctionDeclarations.NoLongClosures maxLines 0.5
$closure = function($a) { return $a * $a; }; // Error, invalid maxLines setting, evaluates to 0.

// phpcs:set Universal.FunctionDeclarations.NoLongClosures maxLines foo
$closure = function($a) { return $a * $a; }; // Error, invalid maxLines setting, evaluates to 0.

// phpcs:set Universal.FunctionDeclarations.NoLongClosures maxLines 8
