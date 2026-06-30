<?php

/*
 * Non-enum scope is ignored.
 */

class Foo {
    protected const VALID_CONST = 1;
    protected function validMethod() {}
}

enum EnumWithNestedAnonClass {
    public function wrapper() {
        return new class {
            protected const NESTED = 1;
            protected function nestedMethod() {}
        };
    }
}


/*
 * Valid enum constant and method visibility modifiers.
 */

enum ValidEnum {
    case Foo;

    private const PRIVATE = 1;
    const IMPLICIT_PUBLIC = 2;
    final public const FINAL_PUBLIC = 3;

    private function privateMethod() {}
    public static function publicStaticMethod() {}
}

enum ValidBackedEnum: string {
    case Foo = 'foo';

    private const string TYPED_PRIVATE = 'x';
    final private function finalPrivateMethod() {}
}

/*
 * Invalid enum constant and method visibility modifiers.
 */

enum InvalidEnum {
    case Foo;

    protected const PROTECTED = 1;
    protected final const PROTECTED_FINAL = 2;
    final protected const PROTECTED_FINAL_2 = 3;
    protected const A = 1, B = 2;
    public const PUBLIC_AFTER_PROTECTED = 4;

    protected
    // phpcs:ignore Stdn.Cat.SniffName -- for reasons.
    final
    /* comment */
    const MULTILINE = 5;

    protected function protectedMethod() {}
    protected /* comment */ static function protectedStaticMethod() {}

    protected
    /* comment */
    static
    // phpcs:ignore Stdn.Cat.SniffName -- for reasons.
    function multiLineModifiers() {}
}

enum InvalidBackedEnum: int {
    case Foo = 1;

    protected const int TYPED_PROT = 1;
    static protected function staticProtectedMethod() {}
    final protected function finalProtectedMethod() {}
}
