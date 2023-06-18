<?php

/*
 * OK.
 */
function NotOurTarget() {}

class FooA {
    protected function NotOurTarget() {}
}

interface FooB {
    function NotOurTarget();
}

enum FooC {
    public function NotOurTarget();
}

$anon = new class {
    function anonClassIsFinalByNature() {}
}

trait MethodsAreAlreadyFinal {
    final public function publicFinalMethod();
    protected final function protectedFinalMethod() {}
}

trait TheseAreExempt {
    public abstract function publicAbstractMethodShouldNotBeFinal();
    abstract protected function protectedAbstractMethodShouldNotBeFinal() {}

    private function privateMethodsCannotBeFinal();

    public function parseError
}

trait FinalMagicMethodsAreNotFlagged {
    final public function __construct() {}
    public final function __destruct() {}
    public final function __clone() {}
    final public function __debugInfo() {}
    final public function __invoke() {}
    public final function __get($name) {}
    public final function __set($name, $value) {}
    final public function __isset($name) {}
    final public function __unset($name) {}
    public final function __call($name, $arguments) {}
    public static final function __callStatic($name, $arguments) {}
    final public function __sleep() {}
    public final function __toString() {}
    public final static function __set_state($properties) {}
    final public function __serialize() {}
    final public function __unserialize($data) {}
}

trait MagicMethodsAreNotFlaggedByDefault {
    public function __construct() {}
    public function __destruct() {}
    public function __clone() {}
    public function __debugInfo() {}
    public function __invoke() {}
    public function __get($name) {}
    public function __set($name, $value) {}
    public function __isset($name) {}
    public function __unset($name) {}
    public function __call($name, $arguments) {}
    public static function __callStatic($name, $arguments) {}
    public function __sleep() {}
    public function __toString() {}
    public static function __set_state($properties) {}
    public function __serialize() {}
    public function __unserialize($data) {}
}


/*
 * Bad.
 */
trait FixMe {
    public function publicMethod() {}
    protected function protectedMethod() {}

    public static function publicStaticMethod() {}
    static protected function protectedStaticMethod() {}

    protected function __doubleUnderscoresButNotMagic() {}

    /**
     * Docblock
     */
    public function withDocblock() {}

    static /*comment*/ protected function withCommentBetweenKeywords() {}

    /*comment*/ protected function withCommentBeforeKeyword() {}
}

// phpcs:set Universal.FunctionDeclarations.RequireFinalMethodsInTraits includeMagicMethods true
trait MagicMethodsAreFlaggedOnRequest {
    public function __construct() {}
    public function __destruct() {}
    public function __clone() {}
    public function __debugInfo() {}
    public function __invoke() {}
    public function __get($name) {}
    public function __set($name, $value) {}
    public function __isset($name) {}
    public function __unset($name) {}
    public function __call($name, $arguments) {}
    public static function __callStatic($name, $arguments) {}
    public function __sleep() {}
    public function __toString() {}
    public static function __set_state($properties) {}
    public function __serialize() {}
    public function __unserialize($data) {}
}

// Reset property to default value.
// phpcs:set Universal.FunctionDeclarations.RequireFinalMethodsInTraits includeMagicMethods false
