<?php

/*
 * Not our target.
 */
use dirname;

class Foo {
    function dirname( $a = __FILE__) {}
    function &dirname( $a = __FILE__) {}
}

$path = Foo::dirname(__FILE__);
$path = $obj->dirname(__FILE__);
$path = $obj?->dirname(__FILE__);
$path = Package\dirname(__FILE__);
$path = \My\Package\dirname(__FILE__);
echo Foo::DIRNAME;
$obj = new dirname(__FILE__);

echo DIRNAME . '/file.php';


/*
 * These should not be flagged.
 */
echo foo(__FILE__);
$path = dirname();
$path = dirname( $file );
$path = dirname( __DIR__ );
$path = dirname( '.' );
$path = dirname( get_path(__FILE__) );
$path = dirname(__FILE__ . '/..');

$path = dirname( ABSPATH . '/path/to/file.php', 3 );
$path = dirname( __DIR__, 3 );

$path = dirname(levels: 2); // ArgumentCountError, require param dirname missing. Ignore as not the concern of this sniff.
$path = dirname( __FILE__, 3, $extra ); // ArgumentCountError, too many args. Ignore as not the concern of this sniff.

$path = dirname( paths: __FILE__ ); // Error: unknown named parameter. Ignore as not the concern of this sniff.
$path = dirname( __FILE__, level: 2); // Error: unknown named parameter. Ignore as not the concern of this sniff.

$path = dirname(\dirname(__DIR__) . '/file.php'); // Nested dirname() call not stand-alone. Silly code, but should not be flagged.


/*
 * These should be flagged for use of dirname(__FILE__).
 */
$path = dirname(__FILE__);
$path = \dirname (   __file__  ,  ) ; // Includes trailing comma.

$path = DirName(__FILE__ /* todo: replace with __DIR__ */); // Not auto-fixable.

// Handling of multi-line function calls.
$path = dirname(
    __FILE__
);

// Uses __FILE__, but also has $levels parameter.
$path = dirname(__FILE__, 1);
$path = dirname(__FILE__, 2);
$path = dirname(__FILE__, 03); // Octal 3.

$path = dirname(__FILE__, $levels); // Not auto-fixable.
$path = dirname(__FILE__, get_levels(2)); // Not auto-fixable.

// With named parameters.
$path = dirname(path: __FILE__, levels: 1);
$path = dirname(levels: 3, path: __FILE__);

// phpcs:ignore Modernize.FunctionCalls.Dirname.Nested -- Only apply __DIR__ fix, not $levels.
$path = dirname(dirname(dirname(dirname(__file__))));


/*
 * These should be flagged for use of nested dirname().
 */
$path = dirname(dirname(dirname(dirname(__DIR__))));
$path = dirname(dirname(DIRNAME(dirname(__DIR__, 2,)))); // Includes trailing comma.

$path = dirname(\dirname($file,), 2); // Includes trailing comma in inner dirname() call.
$path = dirname(dirname(dirname($file), 2), 2);

// Handling of multi-line function calls.
$path = dirname(
    dirname(
        __DIR__,
        2
    ),
    2
);

$path = dirname(
    \dirname(__DIR__, 1), // Comment within the outer dirname() scope.
    2
); // Not auto-fixable.

$path = dirname(
    dirname(
        __DIR__, // Comment within the inner dirname() scope.
        3
    ),
    2
); // Auto-fixable.

$path = dirname(dirname(__DIR__, $levels), 2); // Not auto-fixable.
$path = dirname(dirname(__DIR__, 2), get_levels()); // Not auto-fixable.

$path = dirname(dirname(dirname($file, 2), 2), FOO::LEVELS); // Partially auto-fixable.

// With named parameters.
$path = dirname(levels: 2, path: \dirname(levels: 2, path: DIRNAME(path: dirname(path: __DIR__), levels: 2)));
$path = dirname(levels: 1, path: dirname(levels: 3, path: \DIRNAME(levels: 1, path: dirname(levels: 2, path: __DIR__,)))); // Includes trailing comma.


/*
 * These should be flagged for both.
 */
$path = dirname(dirname(dirname(dirname(__FILE__))));
$path = dirname(DirName(dirname(dirname(__FILE__, 2))));

// With named parameters.
$path = dirname(path: DirName(path: dirname(path: dirname(path: __FILE__))));

// With named parameters, multi-line function call, trailing comma, non-lowercase function call.
$path = dirname(
    path: DirName(
        levels: 2,
        path: dirname(
            path: dirname(
                path: __file__
            ),
            levels: 3,
        )
    )
);


// Parse error.
// This must be the last test in the file.
echo dirname(__FILE__
