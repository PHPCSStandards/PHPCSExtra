<?php

// Multiple statements when in using normal open tags is fine.
$someText = 'something';
echo 'b';

// Single statement in short open echo tags is fine.
?>
<div><?= $someText ?></div>
<div><?= $someText /* comment */ ?></div>
<div><?= $someText; ?></div>
<div><?= $someText, $anotherText, $moreText; //comment
?></div>
<div><?= $someText . $anotherText . ($x + 10); ?></div>
<div><?= ($cond) ? $someText : $anotherText ?></div>

// Multiple statements in short open echo tags should be flagged.
<div><?=$someText;
echo $anotherText;
?></div>
<div><?= $someText;
if ($cond) {
    echo $someText;
} else {
    echo $anotherText;
}
?></div>
<div><?= $someText;
trigger_error('test', E_USER_NOTICE);
?></div>

// Unclosed tag. This must be the last test in the file.
<div><?= $someText
