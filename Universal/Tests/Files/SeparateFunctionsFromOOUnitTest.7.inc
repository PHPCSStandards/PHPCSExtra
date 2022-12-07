<?php

// Invalid: File which declares both named function(s) as well as OO structure(s).

interface IBar {
    function bar();
}

trait TBar {}

function foo() {}
