<?php

/* *** SPACE BASED FILE - NO ERRORS OR WARNINGS EXPECTED AT ALL *** */

/**
 * @param int    $var    Description.
 * @param string $string Another description.
 */

            $expected = ( $column - 1 );
            $found    = ( $this->tokens[ $closer ]['column'] - 1 );
            $error    = 'Array closer not aligned correctly; expected %s space(s) but found %s';
            $data     = array(
                $expected_value => 'data',
                $found          => 'more_data',
            );

/**
 * @param int    $var    Description
 * @param string $string Another description.
 */

            $expected = ( $column - 1 );
            $found    = ( $this->tokens[ $closer ]['column'] - 1 );
            $error    = 'Array closer not aligned correctly; expected %s space(s) but found %s';
            $data     = array(
                $expected_value => 'data',
                $found          => 'more_data',
            );

$a        = true;
$aa       = true;
$aaa      = true;
$aaaa     = true;
$aaaaa    = true;
$aaaaaa   = true;
$aaaaaaa  = true;
$aaaaaaaa = true;

    /**
     * @param   int     $var    Description.
     * @param   string  $string Another description.
     */

$a = <<<    TAB_BETWEEN
text
TAB_BETWEEN;

$a = <<<        'TABS_BETWEEN'
text
TABS_BETWEEN;

function myGenerator() {
    yield       from tabsBetweenShouldBeFixed();

    yield   /*comment*/     from tabsBetweenShouldBeFixed();

    yield
    from tabIndentationShouldBeIgnored();

    yield
    /*comment*/
    from tabIndentationShouldBeIgnored();
}
