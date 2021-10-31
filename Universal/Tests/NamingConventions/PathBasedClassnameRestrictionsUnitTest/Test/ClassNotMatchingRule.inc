<?php
/*
 * Test example
 *
 * - Each test for this sniff is basically just be a simple PHP file with a class declaration in it.
 * - The test files (for the purposes of this sniff as we want to check file paths) need to be somewhere
 *   in the `Universal/Tests/NamingConventions/PathBasedClassnameRestrictionsUnitTest` directory.
 * - The test files can have an arbitrary file name, as long as the file extension is `.inc`.
 *
 * About this example:
 * - Say, we set up a rule that classes in a `/test/` directory must have a suffix `Test`, this class
 *   should be flagged as incorrect as it doesn't have `Test` as the suffix, but as the prefix.
 */

class TestSomething {}
