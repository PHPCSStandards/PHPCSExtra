<?php

// Not our target...
function foo(...$args) {}
callMe($foo, ...$args);
$array = [$a, ...$b, $c];

// First class callables.
callMe(...); // OK.
callMe( ...);
callMe(... );
callMe( ... );
callMe(  ...  );
callMe(

    ...

);
callMe( /*comment*/ ... );

// phpcs:set Universal.WhiteSpace.FirstClassCallableSpacing spacing 1
callMe( ... ); // OK.
callMe(... );
callMe( ...);
callMe(...);
callMe(  ...  );
callMe(


    ...
);
callMe(... /*comment*/ );

// phpcs:set Universal.WhiteSpace.FirstClassCallableSpacing spacing 2
callMe(  ...  ); // OK.
callMe(...  );
callMe(  ...);
callMe(...);
callMe( ... );
callMe(   ...   );
callMe(
    ...


);
callMe(... /*comment*/ );

// Reset the property to its default value.
// phpcs:set Universal.WhiteSpace.FirstClassCallableSpacing spacing 0
