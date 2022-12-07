<?php

// Valid: File which only declares OO structures, both global and namespaced.

namespace {
    abstract class fooA {
        // Methods within OO structures should be ignored by the sniff.
        function get() {}
        abstract function set();
    }

    interface fooB() {}
    trait fooC() {}
    enum fooD {}
}

namespace First {
    class firstFooA() {}
    trait firstFooB() {}
    enum firstFooD {}
}

namespace Second {
    interface secondFooA() {
        // Methods within OO structures should be ignored by the sniff.
        function get();
        function set();
    }

    if (!class_exists('secondFooB')) {
        class secondFooB() {}
    }

    enum secondFooD {}
}

namespace {
    // This sniff has no rules about side-effects.
    $globVar = new class() {
        public function thisIsAnAnonymousClass() {}
    };

    $closure = function($a, $b) {
        return $a + $b;
    };

    $arrow = fn($a, $b) => $a + $b;

    define('MY_CONSTANT', 'foo');

    const ANOTHER_CONSTANT = 'bar';

    while ( true ) {
        // Do something.
    }
}
