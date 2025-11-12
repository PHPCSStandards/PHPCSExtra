<?php

// Intentional parse error. Specifically testing the handling of this and safeguarding it for the future.
#[MyAttribute($param ]
function foo() {}
