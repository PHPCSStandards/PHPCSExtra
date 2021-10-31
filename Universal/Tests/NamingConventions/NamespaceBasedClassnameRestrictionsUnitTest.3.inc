<?php

// Testing the rule order handling.
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[] /Foo/=>/Foo/,/^App\\/=>/Bar$/

namespace Foo {
    class Foo {} // Okay.
    class Bar {} // Error on first matching rule.
}

namespace App\Foo {
    class Foo {} // Okay.
    class Bar {} // Error on first matching rule.
}

namespace Foo\Bar {
    class Foo {} // Okay.
    class Bar {} // Error on first matching rule.
}

namespace App/Bar {
    class Foo {} // Error on second matching rule.
    class Bar {} // Okay.
}

// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[] /^App\\/=>/Bar$/,/Foo/=>/Foo/

namespace App\Fool {
    class Foo {} // Error on first matching rule.
    class Bar {} // Okay.
}

namespace Fooling {
    class Foo {} // Okay.
    class Bar {} // Error on second matching rule.
}

namespace FooBar\App {
    class Foo {} // Okay.
    class Bar {} // Error on the second matching rule.
}

// Reset the property at the end of this file
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[]
