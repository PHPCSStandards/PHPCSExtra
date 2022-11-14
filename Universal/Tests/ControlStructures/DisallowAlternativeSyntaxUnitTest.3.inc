<?php

// Live coding.
// Intentional parse error. This test has to be the last in the file.
if ($a) : ?>
    Inline HTML in the nested if, but nowhere else.
    <?php
else 
    // The above else if missing the colon!
endif;
