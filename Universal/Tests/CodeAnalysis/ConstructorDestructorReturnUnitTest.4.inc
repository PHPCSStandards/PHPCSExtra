<?php

/*
 * This test file is only here to reset the value of the php_version configuration option.
 *
 * The PHP4-style constructor should be recognized as a constructor and handled as usual.
 */

class ReturnsAValue {
    function returnsavalue(): string
    {
        return 'php4style';
    }
}
