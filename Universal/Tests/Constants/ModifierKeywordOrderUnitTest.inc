<?php

/*
 * Not our targets, no keyword possible.
 * Includes some safeguarding against potential tokenizer issues.
 */
namespace Foo\const\bar;
const NAMESPACED = 123;
function_call(const: $var);
class Foo {
    public function const() {}
}

/*
 * OK, no or single keyword, no ordering needed.
 */
class NoOrderingNeeded {
    const NO_MODIFIERS = false;

    public const ONLY_VISIBILITY_PUBLIC = true,
        SECOND_CONSTANT_USING_SAME_MODIFIERS = true;
    protected const ONLY_VISIBILITY_PROTECTED = true;
    private const ONLY_VISIBILITY_PRIVATE = true;
    final const ONLY_FINAL = true;
}

/*
 * OK, expected order with default settings.
 */
class CorrectOrderFinalFirst {
    final public const FINAL_PUBLIC = 'foo';

    #[SomeAttribute]
    final protected const FINAL_PROTECTED = 'foo';

    // "final private" is an oxymoron (and fatal error), but that's not the concern of this sniff.
    final /*comment*/ private const FINAL_PRIVATE = 'foo', FINAL_PRIVATE_TOO = 'bar';
}

/*
 * Bad with default settings.
 */
class IncorrectOrderFinalFirst {
    public final /*comment*/ const PUBLIC_FINAL = 'foo';

    #[SomeAttribute]
    Protected Final const PROTECTED_FINAL = 'foo', PROTECTED_FINAL_TOO = 'bar';

    private
    // comment
    final
    // phpcs:ignore Stdn.Cat.SniffName -- for reasons.
    const PRIVATE_FINAL = 'foo';
}


// phpcs:set Universal.Constants.ModifierKeywordOrder order visibility final

/*
 * OK, expected order with custom settings.
 */
class CorrectOrderFirst {
    public final const FINAL_PUBLIC = 'foo';

    #[SomeAttribute]
    protected final const FINAL_PROTECTED = 'foo';

    /**
     * Docblock.
     */
    private final const FINAL_PRIVATE = 'foo', FINAL_PRIVATE_TOO = 'bar';
}

/*
 * Bad with custom settings.
 */
class IncorrectOrderVisibilityFirst {
    final /*comment*/ public const PUBLIC_FINAL = 'foo';

    #[SomeAttribute]
    final protected const PROTECTED_FINAL = 'foo', PROTECTED_FINAL_TOO = 'bar';

    FINAL
    // comment
    PRIVATE
    // phpcs:ignore Stdn.Cat.SniffName -- for reasons.
    const PRIVATE_FINAL = 'foo';
}


// phpcs:set Universal.Constants.ModifierKeywordOrder order scope final

/*
 * OK, expected order with invalid settings (default is used).
 */
class CorrectOrderUsingDefaultOrderPref {
    final public const FINAL_PUBLIC = 'foo';
}

/*
 * Bad with invalid settings (default is used).
 */
class IncorrectOrderUsingDefaultOrderPref {
    #[SomeAttribute]
    protected final const PROTECTED_FINAL = 'foo', PROTECTED_FINAL_TOO = 'bar';
}

// Reset to default.
// phpcs:set Universal.Constants.ModifierKeywordOrder order final visibility

// Live coding. Ignore as class boundaries cannot be determined yet. This must be the last test in the file.
class LiveCoding {
    protected final const
