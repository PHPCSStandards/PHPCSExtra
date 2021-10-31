<?php

// Testing that the sniff handles invalid regexes correctly.

// The sniff should error out on an invalid property - only value/invalid regex.
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[] `Foo/=>/Foo`

namespace Foo {
    class Foo {} // Error, invalid regex.
    class Bar {} // Error, invalid regex.
}

// The sniff should error out on an invalid property - not a regex.
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[] Foo=>Foo

namespace Bar {
    class Foo {} // Error, invalid regex.
    class Bar {} // Error, invalid regex.
}

// The sniff should error out on an invalid property - broken regex (syntax error).
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[] `[0-9`=>`\w{3`

namespace Baz {
    class Foo {} // Error, invalid regex.
    class Bar {} // Error, invalid regex.
}

// Reset the property at the end of this file
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[]
