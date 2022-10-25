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
}

namespace First {
    class firstFooA() {}
    trait firstFooB() {}
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
}

namespace {
    // This sniff has no rules about side-effects.
    $globVar = new class() {
        public function thisIsAnAnonymousClass() {}
    };

    $closure = function($a, $b) {
        return $a + $b;
    };

    define('MY_CONSTANT', 'foo');

    const ANOTHER_CONSTANT = 'bar';

    while ( true ) {
        // Do something.
    }
}
