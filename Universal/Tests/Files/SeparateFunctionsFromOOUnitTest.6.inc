<?php

// Invalid: File which declares both named function(s) as well as OO structure(s).

function foo() {}

class Bar() {}

if ($a === $b ) {
    function secondFooB() {}
}
