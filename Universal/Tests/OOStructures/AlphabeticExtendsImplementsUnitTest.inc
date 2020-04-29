<?php

/*
 * Nothing to do.
 */
class NoImplements {}
interface NoExtends {}

class ImplementsOne implements Countable {}
interface ExtendsOne extends Throwable {}

class ImplementsOne implements \Vendor\App\Foo {}
interface ExtendsOne extends \Vendor\App\Bar {}

/*
 * OK.
 */
class ImplementsTwoUnqualifiedOk implements Bar, Foo {}
interface ExtendsTwoUnqualifiedOK extends Countable, Throwable {}

/*
 * OK with the default orderby "name" setting.
 */
class ImplementsThreeMixedOk implements Sub\Bar, \Vendor\Package\Boo, Foo {}

/*
 * Incorrect order with the default orderby "name" setting.
 */

class ImplementsTwoUnqualifiedIncorrect implements Foo, Bar {}
interface ExtendsTwoUnqualifiedIncorrect extends Throwable, Countable {}

class ImplementsThreeMixedIncorrect implements Sub\Bar, Foo, \Vendor\Package\Boo {}
interface ExtendsThreeMixedIncorrect extends Foo, Sub\Bar, \Vendor\Package\Boo {}

class ImplementsThreeUnqualifiedMixedCase implements Foo, Bar, boo {}


// phpcs:set Universal.OOStructures.AlphabeticExtendsImplements orderby full

/*
 * OK with the alternative orderby "full" setting.
 */
interface ExtendsThreeFullMixedOK extends Foo, Sub\Bar, \Vendor\Package\Boo {}

/*
 * Incorrect order with the alternative orderby "full" setting.
 */

class ImplementsTwoFullUnqualifiedIncorrect IMPLEMENTS Foo, Bar {}
interface ExtendsTwoFullUnqualifiedIncorrect extends Throwable, Countable {}

class ImplementsThreeFullMixedIncorrect implements Sub\Bar, \Vendor\Package\Boo, Foo {}
interface ExtendsThreeFullMixedIncorrect extends Sub\Bar, Foo, \Vendor\Package\Boo {}


// Pass incorrect setting. Should use the "name" default.
// phpcs:set Universal.OOStructures.AlphabeticExtendsImplements orderby OOname

// Test fixing of multi-line statement.
// Note: Extra whitespace will be removed. This can be fixed up again with a sniff which enforces the multi-line layout.
class WithComments implements
    Sub\Bar,
    Foo,
    \Vendor\Package\Boo {}

// Test handling of comments in implements/extends statement.
class WithComments implements
    Sub\Bar, // Trailing comment.
    Foo,
    // Line comment.
    \Vendor\Package\Boo {}


// Reset to default.
// phpcs:set Universal.OOStructures.AlphabeticExtendsImplements orderby name

// Test parse error/live coding.
// Intentional parse error. This has to be the last test in the file.
class Unfinished extends
