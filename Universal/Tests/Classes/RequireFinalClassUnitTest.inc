<?php

/*
 * OK.
 */
final class FooA {}

final /*comment*/ class FooB extends Something {}

final
    /*comment*/
    class FooC {}

abstract class AbstractBarC implements MyInterface {}

$a = new MyClass() {}

// Parse error. Not our concern.
final abstract class BazD {}

/*
 * Bad.
 */
class BazA {}

    class CheckHandlingOfIndentation extends Something {}

class BazC implements MyInterface {}

// Live coding. Ignore. This must be the last test in the file.
class LiveCoding
