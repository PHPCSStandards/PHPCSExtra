<?php

/*
 * This test file is run with php_version set to a value of 70999 or lower.
 *
 * The PHP4-style constructor should be recognized as a constructor and handled as usual.
 */

class ReturnsAValue {
    public function __construct(): self {
        return $this;
    }

    public function __destruct():string {
        return 'destructed';
    }

    function returnsavalue(): string
    {
        return 'php4style';
    }
}
