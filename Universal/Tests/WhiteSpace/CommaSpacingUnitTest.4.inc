<?php

/*
 * Separate test file as the risk of this test becoming invalid due to IDEs auto-trimming trailing spaces
 * when the file is edited is large.
 */

// The sniff should ignore trailing whitespace after a comma, when the next code is on a new line.
        $trailingWhiteSpaceAfterComma = sprintf(
            str_replace( 'abc', 'def', $variable),    
            $refs
        );
