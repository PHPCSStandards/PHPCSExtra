<?php

/*
 * Tests with PHP 7.3+ flexible heredoc/nowdoc.
 * This must be a separate test case file as it is a parse error in PHP < 7.3.
 *
 * This test file is run with php_version set to a value of 70000 or higher, which means
 * that all heredocs/nowdocs will be treated as traditional heredocs/nowdocs and commas
 * should be on the next line.
 */

/*
 * OK.
 */

// Old-style heredoc/nowdoc.
$array = [
    <<<EOD
    text
EOD
    , <<<'EOD'
    text
EOD
    ,
];

// PHP 7.3+ flexible heredoc/nowdoc.
$array = [
    <<<EOD
    text
    EOD
    , <<<'EOD'
    text
    EOD
    ,
];

/*
 * Incorrect spacing.
 */

// Old-style heredoc/nowdoc, but with what would be a parse error on PHP < 7.3.
$array = [
    <<<EOD
    text
EOD,
    <<<'EOD'
    text
EOD    ,
];

// PHP 7.3+ flexible heredoc/nowdoc.
$array = [
    <<<EOD
    text
    EOD  ,   <<<'EOD'
    text
    EOD,
];
