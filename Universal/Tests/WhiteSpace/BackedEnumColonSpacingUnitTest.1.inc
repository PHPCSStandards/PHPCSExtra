<?php

/*
 * Non-backed enums have no colon and are ignored.
 */
enum NonBacked {}
enum NonBackedImplements implements Bar {}
enum NonBackedWithBody {
    public function label() :string { // Colons unrelated to the backed enum declaration colon are ignored.
        return 'label';
    }
}

/*
 * Valid spacing (using the default property values).
 */
enum ValidInt: int {}
enum ValidImplements: string implements HasLabel {}
enum
    /* comment */
    ValidName: string
    {}

/*
 * Invalid spacing (using the default property values).
 */
enum SpaceBefore : string {}
enum NoSpaceAfter:string {}
enum MultipleSpacesAfter:   string {}
enum SpaceBeforeNoneAfter :string {}
enum MultipleSpacesBeforeAndAfter   : string {} // Error x 2.
enum BadImplements :string implements Foo {} // Error x 2.
enum NewlineBefore
    : string {}
enum NewlineAfter:

    string {}

// No auto-fixing when there are comments around the colon.
enum CommentBefore  /* comment */: string {}
enum CommentAfter:  /* comment */string {}

/*
 * Test non-default property values.
 */
// phpcs:set Universal.WhiteSpace.BackedEnumColonSpacing spacingBefore 1
enum CustomBeforeOk : string {} // OK.
enum CustomBeforeError: string {} // Error.
// Resetting to the default value.
// phpcs:set Universal.WhiteSpace.BackedEnumColonSpacing spacingBefore 0

// phpcs:set Universal.WhiteSpace.BackedEnumColonSpacing spacingAfter 0
enum CustomAfterOk:string {} // OK.
enum CustomAfterError: string {} // Error.

// phpcs:set Universal.WhiteSpace.BackedEnumColonSpacing spacingBefore 2
// phpcs:set Universal.WhiteSpace.BackedEnumColonSpacing spacingAfter 3
enum CustomBothOk  :   string {} // OK.
enum CustomBothError: string {} // Error x 2.
// Resetting to the default value.
// phpcs:set Universal.WhiteSpace.BackedEnumColonSpacing spacingBefore 0
// phpcs:set Universal.WhiteSpace.BackedEnumColonSpacing spacingAfter 1
