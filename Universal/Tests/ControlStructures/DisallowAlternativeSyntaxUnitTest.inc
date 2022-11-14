<?php

/*
 * Control structures without braces. Ignore.
 */
if (true)
    // Deliberately empty.
elseif (false)
    function_call($a);
else
    function_call($a);

for ($i = 1; $i <= 10; $i++)
    echo $i;

foreach ($a as $k => $v)
    echo "Key: $k; Current value of \$a: $v.\n";

while (++$i <= 10)
    echo $i;

if (true) ?>
   Do something unconditionally as the PHP close tag turned the if into an single statement (silently added a ;).
<?php

// Single line for.
for ($i = 1, $j = 0; $i <= 10; $j += $i, print $i, $i++);

// Single line while.
while (++$i <= 10) /*comment*/ ;

// Single line declares.
declare(ticks=1);

declare(ticks=1) ?>
<?php

/*
 * Control structures using curly braces. Ignore.
 */
if ( true ) {
    function_call($a);
} elseif (false) {
    function_call($a);
}
else if (false) {
    function_call($a);
} else {
    // Deliberately empty.
}

for ($i = 1; $i <= 10; $i++) {
    echo $i;
}

foreach ($a as $k => $v) {
    echo "Key: $k; Current value of \$a: $v.\n";
}

while (++$i <= 10) {
    echo $i;
}

switch ($foo) {
    case 1:
        echo '<div>something</div>';
        break;
    default;
        echo '<div>something</div>';
        break;
}

declare(ticks=1) {
    echo 'ticking';
}

/*
 * Alternative control structure syntax.
 */
if (true):
    function_call($a);
elseif (false):
    // Deliberately empty.
else:
    function_call($a);
endif;

for ($i = 1; $i <= 10; $i++)
    :
    echo $i;
endfor;

foreach ($a as $k => $v):
    echo "Key: $k; Current value of \$a: $v.\n";
endforeach;

while (++$i <= 10):
    echo $i;
endwhile /*comment*/ ;

switch ($foo) :
    case 1:
        echo '<div>something</div>';
        break;
    default;
        echo '<div>something</div>';
        break;
endswitch;

declare (ticks = 1):
    echo 'ticking';
enddeclare;

/*
 * Alternative control structure syntax in views/within inline HTML.
 */
?>
<?php if ($a == 5): ?>
A is equal to 5
<?php elseif ($a == 7): ?>
A is equal to 7
<?php else: ?>
A is something else
<?php endif; ?>

<?php for ($i = 1; $i <= 10; $i++) : ?>
    <div id="<?= $i ?>">something</div>
<?php endfor; ?>

<?php foreach ($a as $k => $v): ?>
    <p>Key: <?= $k ?>; Current value of $a: <?= $v ?></p>
<?php endforeach; ?>

<?php while (++$i <= 10): ?>
    <div id="<?php $i ?>">something</div>
<?php endwhile ?>

<?php switch ($foo): ?>
<?php case 1: ?>
    <div>something</div>
<?php default; ?>
    <div>something</div>
<?php endswitch; ?>

<?php declare (ticks = 1): ?>
    ticking
<?php enddeclare; ?>

<?php
// phpcs:set Universal.ControlStructures.DisallowAlternativeSyntax allowWithInlineHTML true

/*
 * Alternative control structure syntaxes without HTML, these should still be fixed.
 */
if (true):
    function_call($a);
elseif (false):
    function_call($a);
else:
    function_call($a);
endif;

for ($i = 1; $i <= 10; $i++)
    :
    echo $i;
endfor;

foreach ($a as $k => $v):
    echo "Key: $k; Current value of \$a: $v.\n";
endforeach;

while (++$i <= 10):
    echo $i;
endwhile /*comment*/ ;

switch ($foo) :
    case 1:
        echo '<div>something</div>';
        break;
    default;
        echo '<div>something</div>';
        break;
endswitch;

declare (ticks = 1):
    echo 'ticking';
enddeclare;

/*
 * Alternative control structure syntax in views/within inline HTML. These should be ignored.
 */
?>
<?php if ($a == 5): ?>
A is equal to 5
<?php elseif ($a == 7): ?>
A is equal to 7
<?php else: ?>
A is something else
<?php endif; ?>

<?php for ($i = 1; $i <= 10; $i++) : ?>
    <div id="<?= $i ?>">something</div>
<?php endfor; ?>

<?php foreach ($a as $k => $v): ?>
    <p>Key: <?= $k ?>; Current value of $a: <?= $v ?></p>
<?php endforeach; ?>

<?php while (++$i <= 10): ?>
    <div id="<?php $i ?>">something</div>
<?php endwhile ?>

<?php switch ($foo): ?>
<?php case 1: ?>
    <div>something</div>
<?php default; ?>
    <div>something</div>
<?php endswitch; ?>

<?php declare (ticks = 1): ?>
    ticking
<?php enddeclare; ?>

<?php
// phpcs:set Universal.ControlStructures.DisallowAlternativeSyntax allowWithInlineHTML false

// Live coding.
// Intentional parse error. This test has to be the last in the file.
    if ($a) {
        function_call($a);
    } else {
        // Code.
