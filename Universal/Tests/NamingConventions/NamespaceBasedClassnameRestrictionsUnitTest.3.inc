<?php

// Set up the class name rules property for the tests.
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[] /Foo/=>/Foo/,/^App\\/=>/Bar$/

namespace App\Foo {
    class Foo {}
    class Bar {}
}

// Reset the property at the end of this file
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[]
