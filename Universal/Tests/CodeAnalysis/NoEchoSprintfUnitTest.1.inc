<?php

/*
 * Not our targets.
 */
echo function_call();

echo '<div>' . sprintf('%s - %d', $string, $number) . '</div>';

echo \sprintf('%s - %d', $string, $number), 'text', sprintf('%s - %d', $string, $number);

echo 'text' . sprintf('%s - %d', $string, $number);

echo sprintf('%s - %d', $string, $number), \sprintf('%s - %d', $string, $number);

/*
 * The issue.
 */
echo sprintf('%s - %d', $string, $number);
echo \sprintf(
    '%s',
    $string,
) ?>
<?php

echo /*comment*/ SPRINTF('%s - %d', $string, $number);

echo \SprintF /*comment*/ ('%s - %d', $string, $number) /*comment*/ ;

echo vsprintf('%s - %d', [$string, $number]);
echo \VsprintF('%s - %d', [$string, $number]);

// Intentional parse error/live coding.
// This needs to be the last test in the file.
echo
