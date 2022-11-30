<?php

/*
 * OK.
 */
class FooA {}

class FooB extends Something {}

abstract class AbstractBarC implements MyInterface {}

$a = new MyClass() {}

class FooC {
    // Constant, not class (PHP 8.1).
    final const BAZ = 10;

    // Method, not class.
    final function bar() {}
}

/*
 * Bad.
 */
final class FinalClass {}

final

      class CheckHandlingOfSuperfluousWhitespace extends Something {}

    final class CheckHandlingOfIndentation {}

final /*comment*/ class CheckHandlingOfComments implements MyInterface {}

// Test fixer when combined with PHP 8.2 "readonly" modifier.
readonly final class ReadonlyFinalClass {}

final readonly class FinalReadonlyClass {}

// Parse error. Remove the final keyword.
final abstract class ForbiddenAbstractFinal {}

// Live coding. Ignore. This must be the last test in the file.
final class
