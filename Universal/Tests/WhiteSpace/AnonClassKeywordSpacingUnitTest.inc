<?php

/*
 * OK.
 */
$anon = new class; // Parse error, not our concern.

// No parentheses, not our concern.
$anon = new class {};
$anon = new class
{
	function foo();
};

$anonWithAttribute = new #[SomeAttribute('summary')] class {
    public const SOME_STUFF = 'foo';
};

/*
 * Default setting of 0 spaces.
 */

// Correct spacing between keyword and parentheses.
$anon = new class() {};
$anon = new class($paramA, $paramB) {};

// Incorrect spacing - too much space.
$anon = new class () {};
$anon = new class      ($foo) {};
$anon = new class
	($foo)
{
	function foo();
};

// Incorrect spacing - comment between keyword and parentheses, not auto-fixable.
$anon = new class/*comment*/() {};
$anon = new class   /*comment*/   ($foo) {};
$anon = new class // comment.
	($foo)
{
	function foo();
};

/*
 * Custom setting of 1 space.
 */

// phpcs:set Universal.WhiteSpace.AnonClassKeywordSpacing spacing 1

// Correct spacing between keyword and parentheses.
$anon = new class () {};
$anon = new class ($paramA, $paramB) {};

// Incorrect spacing - too little space.
$anon = new class() {};
$anon = new class($paramA, $paramB) {};

// Incorrect spacing - too much space.
$anon = new class      ($foo) {};
$anon = new class
	($foo)
{
	function foo();
};

// Incorrect spacing - comment between keyword and parentheses, not auto-fixable.
$anon = new class/*comment*/() {};
$anon = new class   /*comment*/   ($foo) {};
$anon = new class // comment.
	($foo)
{
	function foo();
};

/*
 * Custom setting of 4 spaces.
 */

// phpcs:set Universal.WhiteSpace.AnonClassKeywordSpacing spacing 4

// Correct spacing between keyword and parentheses.
$anon = new class    () {};
$anon = new class    ($paramA, $paramB) {};

// Incorrect spacing - too little space.
$anon = new class() {};
$anon = new class  ($paramA, $paramB) {};

// Incorrect spacing - too much space.
$anon = new class       () {};
$anon = new class       ($foo) {};
$anon = new class
	($foo)
{
	function foo();
};

// Reset property.
// phpcs:set Universal.WhiteSpace.AnonClassKeywordSpacing spacing 0

// Live coding - this has to be the last test in the file without a new line after it.
$anon = new class