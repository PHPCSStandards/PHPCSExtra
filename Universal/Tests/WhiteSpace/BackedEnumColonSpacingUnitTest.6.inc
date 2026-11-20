<?php

// Intentional parse error (a backed enum missing a backing type).
// This should be the only test in the file.

enum NoBackingTypeWithImplements:   implements Foo {}
