<?php

/*
 * Valid spacing (using the default property values).
 */
foo(name: $value);
$obj->method(label: /* comment */ $value);
Foo::bar(first: false, second: 'text');
new MyClass(
    first: 10,
    second: 'text',
);
die(status: 1);
new class(name: SOME_CONSTANT) {};

/*
 * Invalid spacing.
 */
foo(name : true);
$obj->method(name:$value);
Foo::bar(first : false, second : 'text');
new MyClass(argument :  10);
exit(status :1);
new class(name :  $value) {};
$obj?->method(name : nested(value:$value));
#[MyAttribute(
    key
    :
        'value'
)]
class Baz {}
foo(
    // Comment.
    first :$a,
    second:$b, // Comment.
    third  :  $c,
);
foo(
    // Comment.
    first :$a,
            second:$b /* Comment. */ , third  :  $c
    , fourth:
        1
                + // phpcs:ignore Stnd.Cat.Sniff -- for reasons
$d
);

// Comments around the colon are reported, but not auto-fixed.
foo(name  /* comment */ : $value);
foo(name:  /* comment */ $value);

// phpcs:set Universal.WhiteSpace.NamedArgumentSpacing spacingBefore 1
foo(name : $value);
foo(name: $value);
foo(name  : $value);
// Resetting to the default value.
// phpcs:set Universal.WhiteSpace.NamedArgumentSpacing spacingBefore 0

// phpcs:set Universal.WhiteSpace.NamedArgumentSpacing spacingAfter 0
foo(name:$value);
foo(name: $value);

// phpcs:set Universal.WhiteSpace.NamedArgumentSpacing spacingBefore 2
// phpcs:set Universal.WhiteSpace.NamedArgumentSpacing spacingAfter 3
foo(name  :   $value);
foo(name:$value);
// Resetting to the default value.
// phpcs:set Universal.WhiteSpace.NamedArgumentSpacing spacingBefore 0
// phpcs:set Universal.WhiteSpace.NamedArgumentSpacing spacingAfter 1
