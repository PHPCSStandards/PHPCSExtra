<?php

/*
 * The PHP4-style constructors are not constructors in namespaced files.
 * No errors should be thrown for it, nor any auto-fixes made.
 */
namespace Some\Name;

class ReturnsAValue {
    function returnsAValue(): string
    {
        return 'php4style';
    }
}
