<?php

/*
 * Tests with PHP 7.3+ flexible heredoc/nowdoc.
 * This must be a separate test case file as it is a parse error in PHP < 7.3.
 *
 * This test file is run without a php_version set, which means that the auto-fixer
 * will kick in based on it detecting that whether something is a flexible heredoc/nowdoc.
 *
 * Old-style heredoo/nowdoc will be enforced to have a new line between the closer and
 * the comma.
 * New-style heredoc/nowdoc will be enforced to have no space between the closer and the comma.
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
    EOD, <<<'EOD'
    text
    EOD,
];

/*
 * Incorrect spacing.
 */

// Old-style heredoc/nowdoc, but with what would be a parse error on PHP < 7.3.
$array = [
    <<<EOD
    text
EOD  ,  <<<'EOD'
    text
EOD,
];

// PHP 7.3+ flexible heredoc/nowdoc.
$array = [
    <<<EOD
    text
    EOD  ,   <<<'EOD'
    text
    EOD
    ,
];
