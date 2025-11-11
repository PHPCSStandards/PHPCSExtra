<?php

// Intentional parse error. Specifically documenting the handling of this and safeguarding it for the future.
#[MyAttribute($param, AnotherAttribute() ]
function foo() {}
