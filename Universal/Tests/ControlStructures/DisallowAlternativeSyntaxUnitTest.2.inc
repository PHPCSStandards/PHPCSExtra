<?php

// Live coding.
// Intentional parse error. This test has to be the last in the file.
    if ($a) :
        function_call($a);
    else
        // The above else if missing the colon!
    endif;
