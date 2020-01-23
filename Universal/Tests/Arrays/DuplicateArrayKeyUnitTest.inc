<?php

/*
 * These will not be analysed as determining runtime value of variables, constants and function
 * calls is not supported.
 */
$excluded = [
    $var                        => 'excluded',
    MY_CONSTANT                 => 'excluded',
    PHP_INT_MAX                 => 'excluded',
    str_replace('.', '', '1.1') => 'excluded',
    self::CONSTANT              => 'excluded',
    $obj->get_key()             => 'excluded',
    $obj->prop                  => 'excluded',
    "my $var text"              => 'excluded',
    <<<EOD
my $var text
EOD
                                => 'excluded',
    $var['key']{1}              => 'excluded',
];

/*
 * Let's find some duplicates.
 */

$emptyStringKey = array(
    ''             => 'empty',
    // All below will error.
    null           => 'null',
    (string) false => 'false',
);

$everythingZero = [
    '0',
    // All below will error.
    0                => 'a',
    0.0              => 'b',
    '0'              => 'c',
    0b0              => 'd',
    0x0              => 'e',
    00               => 'f',
    false            => 'g',
    0.4              => 'h',
    -0.8             => 'i',
    0e0              => 'j',
    0_0              => 'k',
    -1 + 1           => 'l',
    3 * 0            => 'm',
    00.00            => 'n',
    (int) 'nothing'  => 'o',
    15 > 200         => 'p',
    "0"              => 'q',
    0.               => 'r',
    .0               => 's',
    (true) ? 0 : 1   => 't',
    ! true           => 'u',
];

$everythingOne = [
    '0',
    '1',
    // All below will error.
    1                => 'a',
    1.1              => 'b',
    '1'              => 'c',
    0b1              => 'd',
    0x1              => 'e',
    01               => 'f',
    true             => 'g',
    1.2              => 'h',
    1e0              => 'i',
    0_1              => 'j',
    -1 + 2           => 'k',
    3 * 0.5          => 'l',
    01.00            => 'm',
    (int) '1 penny'  => 'n',
    15 < 200         => 'o',
    "1"              => 'p',
    1.               => 'q',
    001.             => 'r',
    (true) ? 1 : 0   => 's',
    ! false          => 't',
    (string) true    => 'u',
];

$everythingEleven = [
    11               => 'a',
    // All below will error.
    11.0             => 'b',
    '11'             => 'c',
    0b1011           => 'd',
    0Xb              => 'e',
    013              => 'f',
    11.8             => 'g',
    1.1e1            => 'h',
    1_1              => 'i',
    0_13             => 'j',
    -1 + 12          => 'k',
    22 / 2           => 'l',
    0011.0011        => 'm',
    (int) '11 lane'  => 'n',
    "11"             => 'o',
    11.              => 'p',
    35 % 12          => 'q',
];

$textualStringKeyVariations = [
    'abc'      => 1,
    'def'      => 2,
    'ghi'      => 3,
    // All below will error.
    'ab' . 'c' => 4, // Error.
    <<<EOT
def
EOT
               => 5, // Error.
    <<< 'NOW'
ghi
NOW
               => 6, // Error.
    "abc"      => 7, // Error.
];

$testKeepingTrackOfHighestIntKey = array(
    ''         => 'empty',
    'a',                  // Int 0
    'b',                  // Int 1
    1          => 'c',    // Int 1 - Error.
    5          => 'd',    // Int 5
    'e',                  // Int 6
    6          => 'f',    // Int 6 - Error.
    false      => 'g',    // Int 0 - Error.
    true       => 'h',    // Int 1 - Error.
    1.1        => 'i',    // Int 1 - Error.
    6.5        => 'j',    // Int 6 - Error.
    05         => 'k',    // Int 5 - Error.
    0_6        => 'l',    // Int 6 - Error. PHP 7.4 octal numeric literal.
    0x1        => 'm',    // Int 1 - Error.
    0b0        => 'n',    // Int 0 - Error.
    null       => 'o',    // Empty string - Error.
    02.6e7     => 'p',    // Int 26000000
    '96'       => 'q',    // Int 96
    'r',                  // Int 26000001
    '26000001' => 's',    // Int 26000001 - Error.
    '96.3'     => 't',    // String '96.3'
    1 + 0      => 'u',    // Int 1 - Error.
    1.1 - 0.5  => 'v',    // Int 0 - Error.
    -1         => 'w',    // Int -1
    'x',                  // Int 26000002
    '9' . '6'  => 'y',    // Int 96 - Error.
    '1.'       => 'z',    // String '1.'
);
