<?php

/*
 * Various parse errors.
 * As the comma in each of these cases either is adjacent to another comma or to a brace, these should all be ignored.
 */
foo(,);
foo('function', 'bar',,);
foo('function',, 'bar');
foo(, 'function', 'bar');

$closure = function() {
	typo_comma_not_semicolon(),
};

// Empty list, not allowed since PHP 7.0, but not our concern.
list(,,) = $array;

/*
 * These should all be OK.
 */
$a = function_call( $a, $b, $c, $d );
$a = function_call( $a, $b, /*comment*/ $c, $d );

$a = function_call(
    $a,
    $bbb,
    $ccccc
);

$a = function_call(
    $a, // Comment.
    $bbb, // Comment.
    $ccccc // Comment.
);

$array = array('a', 'b', 'c');
$array = ['a', 'b', 'c',];
$array = [
    $item1,
    $item2,
];

list(, $a, , $b,,) = $array;
list(, $a, /*ignored*/, $b, /*ignored*/,) = $array;
[, $a, , $b,,] = $array;
list(
    ,
    $a,
    ,
    $b,
    ,
) = $array;

// Parse error in PHP < 7.2 (comma after last item in group use).
use Vendor\Package\{NameA, NameB, NameC,};

// Parse error in PHP < 7.3 (comma after last item in call).
$a = function_call($a, $b, $c, $d,);
$a = function_call(
    $a,
    $b,
    $c,
    $d,
);

// Parse error in PHP < 8.0 (comma after last item in param list and closure use).
$closure = function ($param1, $param2, $param3,) use($use1, $use2, $use3,) {};
$closure = function (
    $param1,
    $param2,
    $param3,
) use(
    $use1,
    $use2,
    $use3,
) {};


/*
 * Tests specific to creation of the error messages.
 */

// Allow for preceeding/following code - which is used in the error message - to have % signs in it.
sprintf( 'my %s and %d' , 'my %s and %d' );
define( 'START',   '%C!&bq' );
define( 'MIDDLE',  '`cx]%1&K' );
define( 'END',     '27t`cx]%' );

// But don't double escape pre-escaped % signs.
define( 'START',   '%%C!&bq' );
define( 'MIDDLE',  '`cx]%%1&K' );
define( 'END',     '27t`cx]%%' );

/*
 * Incorrect spacing errors.
 */

function_call($param1  ,   $param2,$param3);
function_call(
    $param1  ,
    $param2,
);

$a = function_call(
    $a,    // Comment.
    $bbb,  // Comment.
    $ccccc // Comment.
);

$a = commentsAreNotTrailing($a,    /*comment*/ $bbb,  /* Comment. */ $ccccc   /* Comment. */ );

$a = function_call(
    $a
    ,$b // Comment.
    ,$c /* Comment */
    ,$d
);

$a = function_call(
    $a
    ,
    $b
    ,
    $c
    ,
    $d
);

$a = function_call(
    $a,// Comment.
    $b,// Comment.
    $c// Comment.
);

// Parse error in PHP < 7.3 (comma after last item in call).
$a = function_call( $a  ,$b
   ,    $c
   ,$d   , );

// Parse error in PHP < 7.3 (comma after last item in call).
$a = function_call(
    $a  ,
    $b  ,
    $c  ,
    $d  ,
);

$array = array($item1,$item2  ,  $item3);
$array = array('a'  ,   /*comment*/ 'b'   ,    'c');

$array = [
    $item1,
    $item2  ,
];
$array = ['a'
  ,'b'
  ,'c'
];

list($a  ,$b,,$d   , ) = $array;
list(, $a,/*ignored*/   , $b,/*ignored*/   ,) = $array;

[
    $a
    ,
    $b
    ,
    ,
    $d
] = $array;


list( ,$a, $b  ,,) = $array;
list(
    ,
    $a,
    $b  ,,
) = $array;

// Allow for empty list item at start, middle and end of list.
list( , $b, ,$d   , ) = $array;
[
    ,
    $b
    ,
    ,
    $d
    ,
] = $array;

// Alignment of values within a multi-dimensional array is not allowed.
return [
    // github
    ['https://github.com/foo/bar/zipball/abcd',      'https://api.github.com/repos/foo/bar/zipball/newref'],
    ['https://www.github.com/foo/bar/zipball/abcd',  'https://api.github.com/repos/foo/bar/zipball/newref'],
    ['https://github.com/foo/bar/archive/abcd.zip',  'https://api.github.com/repos/foo/bar/zipball/newref'],
];

// ... nor is alignment of array values in multi-statements.
$provider[] = ['abc',             '0.10'];
$provider[] = ['defghi',          '1.0.0BETA3'];
$provider[] = ['jklmnopqrstuvwz', '2.2.0-DEV'];
