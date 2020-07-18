<?php

/*
 * Not our concern.
 */
echo bar::classProp; // Not the keyword.
$anon = new class {}; // Anonymous class, not the keyword.

/*
 * OK.
 */
namespace foo {
    class bar {}

    echo bar::class; // foo\bar
}

namespace MyNameSpace {
    class xyz {}

    remove_filter('theme_filter', [\MyNameSpace\xyz :: /* comment */ class, 'methodName'], 30);
}

/*
 * Not OK.
 */
echo bar::CLASS;

array_map([\MyNameSpace\xyz :: /* comment */ Class, 'methodName'], $array);
