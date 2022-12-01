<?php

// Valid: File which doesn't declare named functions or OO structures.

$globVar = new class() {
    public function thisIsAnAnonymousClass() {}
};

/**
 * Docblock
 */
$closure = function($a, $b) {
    return $a + $b;
};

$arrow = fn($a, $b) => $a + $b;

define('MY_CONSTANT', 'foo');

const ANOTHER_CONSTANT = 'bar';

while ( true ) {
    $array      = array( 1, 2, 3 );
    $list       = list( 1, 2, 3 );
    $shortArray = [ 1, 2, 3 ];
    [ 1, 2, 3 ] = $shortList;

    $array['access'] = 'key';
}

$heredoc = <<<EOD
text
EOD;

$nowdoc = <<<'EOD'
text
EOD;
