<?php

/*
 * Tests specifically for PHP 7.3 flexible heredoc/nowdoc.
 * These tests will only work on PHP 7.3+ as the tokenizer will return garbage in PHP < 7.3.
 */

// OK.
$array = [
    'heredoc' => <<<EOD
        Some content
    EOD,
];

$array = [
    'quoted heredoc' => <<<"EOD"
        Some content
    EOD,
];

$array = [
    'nowdoc' => <<<'EOD'
        Some content
    EOD,
];

// Missing comma.
$array = [
    'heredoc' => <<<EOD
        Some content
    EOD
];

$array = [
    'quoted heredoc' => <<<"EOD"
        Some content
    EOD
];

$array = [
    'nowdoc' => <<<'EOD'
        Some content
    EOD
];
