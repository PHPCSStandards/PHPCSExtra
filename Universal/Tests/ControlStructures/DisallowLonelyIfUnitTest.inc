<?php

/*
 * Else blocks which don't have a lonely if statement.
 */
if ($condition) {
    doSomething();
} else if ($anotherCondition) {
    doSomething();
}

if ($condition) {
    doSomething();
} elseif ($anotherCondition) {
    if ($subCondition) {
        doSomething();
    }
} else {
    doSomething();
}

if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    }

    doSomethingElse();
}

if ($condition) {
    doSomething();
} else {
    doSomethingElse();

    if ($anotherCondition) {
        doSomething();
    }
}

if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    }

    if ($secondIf) {
        doSomething();
    }
}

/*
 * Variations of If - else blocks without curly braces. Ignore.
 */
if ($condition)
    doSomething();
else
    if ($anotherCondition)
        doSomething();

if ($condition)
    doSomething();
else
    if ($anotherCondition) {
        doSomething();
    }

if ($condition)
    doSomething();
else {
    if ($anotherCondition)
        doSomething();

    doSomethingElse();
}

/*
 * Lonely if statements in else blocks.
 */
if ($condition) { doSomething(); } else { if ($anotherCondition) { doSomething(); } }

if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    }
}

if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    } else {
        doSomething();
    }
}

if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    } else if ($yetAnotherCondition) {
        doSomething();
    } else {
        doSomething();
    }
}

if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    } elseif ($yetAnotherCondition) {
        doSomething();
    }
}

// Also test it with alternative syntax.
if ($condition):
    doSomething();
else:
    if ($anotherCondition):
        doSomething();
    endif;
endif;

if ($condition):
    doSomething();
else  :
    if ($anotherCondition):
        doSomething();
    else:
        doSomething();
    endif  ;
endif;

if ($condition):
    doSomething();
else:
    if ($anotherCondition):
        doSomething();
    elseif ($yetAnotherCondition):
        doSomething();
    else:
        doSomething();
    endif;
endif;

// Testing the fixing of mixed curly braces and alternative syntax.
if ($condition) {
    doSomething();
} else {
    if ($anotherCondition):
        doSomething();
    elseif ($yetAnotherCondition):
        doSomething();
    else:
        doSomething();
    endif;
}

if ($condition):
    doSomething();
else:
    if ($anotherCondition) {
        doSomething();
    } elseif ($yetAnotherCondition) {
        doSomething();
    } else {
        doSomething();
    }
endif;

/*
 * Fixer specific test cases. Making sure the fixer handles comments correctly.
 */
if ($condition) { doSomething(); } else { if ($anotherCondition) { /* comment */ doSomething(); } }

if ($condition) {
    doSomething();
} else /* comment */ {
    if ($anotherCondition) {
        doSomething();
    }
}

if ($condition) {
    doSomething();
} else { /* comment */
    if ($anotherCondition) {
        doSomething();
    }
}

if ($condition) {
    doSomething();
} else { /* comment */
    if ($anotherCondition) { /* comment */
        doSomething();
    }
}

// Report, but leave unfixed. Unclear where the comment should go.
if ($condition) {
    doSomething();
} else {
    /* comment */
    if ($anotherCondition) {
        doSomething();
    }
}

if ($condition) {
    doSomething();
} else {
    if /* comment */ ($anotherCondition) {
        doSomething();
    }
}

// Report, but leave unfixed. Unclear where the comment should go.
if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    } /* comment */
}

// Report, but leave unfixed. Unclear where the comment should go.
if ($condition):
    doSomething();
else:
    if ($anotherCondition):
        doSomething();
    endif /* comment */;
endif;

// Intentional parse error. Report, but leave unfixed.
if ($condition):
    doSomething();
else:
    if ($anotherCondition):
        doSomething();
    endif
endif;

// Empty else. Ignore.
if ($a) {
    doSomething();
} else {}

// Intentional parse error.
if ($a) {
    doSomething();
} else {
    if ($anotherCondition {
        doSomething();
    }
}

/*
 * Inner block mixing conditions with and without curly braces (which is perfectly valid in PHP).
 * Bow out as it cannot be determined reliably whether there is something behind the last condition.
 */
if ($condition) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    } else if ($secondIf)
        doSomething();
}

// Live coding.
// Intentional parse error. This test has to be the last in the file.
if ($a) {
    doSomething();
} else {
    if ($anotherCondition) {
        doSomething();
    }
