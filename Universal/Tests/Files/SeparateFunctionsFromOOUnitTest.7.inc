<?php

// Invalid: File which declares both function(s) as well as OO structure(s).

interface IBar {
    function bar();
}

trait TBar {}

function foo() {}
