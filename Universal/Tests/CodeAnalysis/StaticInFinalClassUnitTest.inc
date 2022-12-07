<?php

/*
 * Not our target: prevent false positives.
 */
class NotTargetStatic {

    static $php4StyleStaticProp;

    public static string|int $phpModernStaticProp;

    protected static function staticMethod()
    {
        static $a, $b;

        $var = namedParams(static: $foo);
        $var = namedParams($bar, static: $foo);
    }
}

trait UseContextUnknown {
    public function unionType(): int|static|false
    {
        $var = static::$prop;
        $var = static::CONSTANT;
    }
}

final class ClosuresAreNotTargettedByThisSniff {
    public static $className = 'Bar';
    public function foobar() {
        $closure = static function(): static {
            // Returns new instance of Closure, not of ClosuresAreNotTargettedByThisSniff.
            // Still unnecessary, but not the target of this sniff.
            // Should possibly get its own sniff.
            return new static();
        };
    }
}


/*
 * Not valid in any PHP version.
 */
final class InvalidUseOfStatic
{
    const INVALID_IN_CONSTANT_DECLARATION = static::class;

    protected int|static $notAllowedAsPropertyType;

    public function NotAllowedAsParamType(static $param) {}

    public function NotAllowedInDefaultValue($paramA = new static(), $paramB = static::MY_CONST) {}
}

$closure = function() {
    static::outsideClassContext();
};

function foobar() {
    static::outsideClassContext();
};

static::$outsideClassContext;

function arrowNotInOO() {
    $arrow = static fn(): static => new static();
}


/*
 * OK, not used in a final class.
 */
abstract class ValidUseOfStaticInAbstract
{
    public function usingStatic($param) : static
    {
        $var = static::functionCall();
        $var = static::class;

        $var = $obj instanceof static;

        $var = new static;
        $var = new static::$className;
    }
}

class ValidUseOfStaticInConcrete extends Foo
{
    public function unionType(): int|static|false
    {
        $var = static::$prop;
        $var = static::CONSTANT;

        $var = new static();
    }
}

interface NeverFinal {
    public function typedMethod(): static|ArrrayAccess;
}


/*
 * Unnecessary use of static for late static binding.
 */
final class FinalClass
{
    public function usingStatic($param) : static
    {
        $var = static::functionCall();
        $var = static::class;

        $var = $obj instanceof static;

        $var = new static;
    }
}

function foo() {
    // Nested in global function to ensure nested code is not skipped over.
    $anon = new class extends AnonClassIsAlwaysFinal {
        public function unionType(): int|static|false
        {
            $var = static::$prop;
            $var = static::CONSTANT;

            $var = $obj
                instanceof
                // Comment.
                static;

            $var = new static();
        }
    };
}

class NonFinalClassWithNesting {
    function foo() {
        // Nested in non-final class to ensure nested code is not skipped over.
        $anon = new class extends AnonClassIsAlwaysFinal {
            public function unionType(): int|static|false
            {
                $var = static::$prop;
                $var = static::CONSTANT;

                $var = $obj
                    instanceof
                    // Comment.
                    STATIC;

                $var = new static::$className;
            }
        };
    }
}

enum FinalByDesign {
    public function typedMethod(): static|ArrrayAccess {
        $var = static::functionCall();
        $var = static::class;

        $var = $obj instanceof static;

        $var = new static;
    }
}

final class ArrowFunctionsAreOpen {
    public function foobar() {
        $arrow = static fn(): static => new static();
    }
}


// Live coding. This has to be the last test in the file.
class LiveCoding extends Foo {
    public static function bar(): static {}

    function baz() {
        $var = $obj instanceof static;
