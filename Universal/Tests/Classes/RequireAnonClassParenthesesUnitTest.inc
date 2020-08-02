<?php

/*
 * OK.
 */
$a = new MyClass();

$anon = new class() { // OK.
    public static function get_instance() {
        return new self(); // Even though within anon class, it's not the anon class instantiation we're looking for.
    }
}

$util->doSomething( new class() {} ); // OK.
$b = new class( 10 ) extends SomeClass implements SomeInterface {}; // OK.
$anon = new class // Comment
    () {}; // OK.

/*
 * Bad.
 */
$util->doSomething( new class {} );
$b = new class extends SomeClass implements SomeInterface {};

// Live coding.
// Intentional parse error. This has to be the last test in the file.
$anon = new class
