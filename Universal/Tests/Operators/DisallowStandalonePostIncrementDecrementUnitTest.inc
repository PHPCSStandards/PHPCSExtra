<?php

/*
 * These are ok.
 */
$i = 10;
--$i;
-- $i;
-- /*comment*/ $i;
    ++$i;
    ++
    $i;
    ++/*comment*/$i;

if (true) {
    ++ClassName::$v;
--\Fully\Qualified\ClassName::$v;
    ++namespace\ClassName::$v;
}

++self::$v;--self::$v;

--$a[0];

++$obj->prop;
--$obj->prop;

/*
 * These should throw errors.
 */
$i--;
$i        --;
$i /*comment*/ --;
    $i++;
    $i ++;
    $i /*comment*/ ++;

$a[0]--;

if (true) {
    ClassName::$v++;
\Fully\Qualified\ClassName::$v--;
    namespace\ClassName::$v++;
}

self::$v++;self::$v--;

           $obj->prop ++;
/*comment*/ $obj-> /*comment*/ prop --;

$obj->prop[$value[2]]++;
$var['key' . ($i + 10) . 'key']--;

/*
 * Report on, but don't auto-fix, statements with multiple in/decrementers.
 */
++$i--;
++ -- $i ++ ++;

/*
 * Don't touch non-stand-alone statements.
 */
while ($i++ && $i < 10);

for ($i = 0; $i < 10; $i++) {}

function_call($i--, $j++);

$a = 10 + $i++ - 5;

return $a['key'][$i++];

// Intentional parse error.
++;
