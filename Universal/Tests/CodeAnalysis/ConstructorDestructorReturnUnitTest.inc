<?php

/*
 * OK.
 */

// Global function, not a constructor/destructor.
function __construct() : int {
    return 123;
}

function __destruct() : float {
    return 321;
}

// Methods which are not constructors can be disregarded.
class NotAConstructor {
    public function __set($name, $value): void {
        // Do something.
    }

    public function Foo(): void {
        // Do something.
    }

    public function Bar() {
        return $this;
    }
}

// Constructor/Destructor without a return statement or return type.
class NoReturn {
    protected function __construct()
    {
        // Do something.
    }

    protected function __destruct()
    {
        // Do something.
    }

    // Also applies to PHP4-style constructors/destructors.
    function NoReturn()
    {
        // Do something.
    }

    function _NoReturn()
    {
        // Do something.
    }
}

// Constructor/Destructor with return statement, but no value.
$anon = new class extends ReturnNoValue {
    public function __construct() {
        if ($foo) {
            return   ;
        } else {
            return /* comments are fine */
            // Even when spread over multiple lines.
            ;
        }

        return;
    }

    public function __destruct() {
        // Do something.
        return;
    }

    // Non-constructor/destructor method returning.
    public function returnsavalue() {
        return 'php4style';
    }
};


/*
 * Not OK.
 */
class ReturnsAValue {
    public function __construct(): self {
        return $this;
    }

    public function __destruct():string {
        return 'destructed';
    }

    function returnsavalue()
    {
        return 'php4style';
    }
}

$anon = new class() extends ReturnsAValue {
    public function __Construct()
    :    static|self
    {
        return $this;
    }

    public function __deStRucT() {
        return 'destructed';
    }
};

/*
 * Return types are not allowed on constructor/destructor methods (fatal error).
 */

trait AbstractConstructorDestructorReturnTypes {
    abstract public function __construct() : int;

    abstract public function __destruct():string;
}

interface InterfaceMethodReturnTypes {
    public function __construct(): /*comment*/ void;

    public function __destruct(): void;
}
