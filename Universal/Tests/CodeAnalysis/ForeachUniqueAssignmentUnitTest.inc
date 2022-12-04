<?php

/*
 * Not an issue.
 */
// No double arrow in assignment.
foreach ($array as $v ) {}
foreach (array( 1 => 'value') as $v ) {}

// Unique variables.
foreach ($array as $k => $v ) {}
foreach ($array as $k => &$v ) {}
foreach ($array as $k['key'] => $k['value'] ) {}
foreach ($array as $k[$name] => $k[$value] ) {}
foreach ($data as $key => [$id, [$name, $address]]) {}
foreach ($data as $key => list("id" => $id, "name" => $name)) {}
foreach ($array as $key => list($a) ) {}

/*
 * The issue.
 */
foreach ($array as $k => $k ) {}
foreach ($array as /*comment*/ $k [ 'key' ] => $k['key'] ) {}
foreach ($array as $k[$name /*comment*/] => $k[/*comment*/ $name] ) {}
foreach ($array as [$a] => [$a] ) {}
foreach ($array as list($a) => list($a) ) {}
foreach ( $data as $this->prop['key'] => $this->prop['key'] ) {}

// Also detect the same variable being used in combination with a reference assignment.
foreach ($a as $k => &$k) {}

/*
 * Parse errors, not our concern.
 */
foreach ($array) {} // Missing "as".
foreach ($array as $k => $k
