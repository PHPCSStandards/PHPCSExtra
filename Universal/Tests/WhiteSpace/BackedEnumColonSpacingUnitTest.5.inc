<?php

// Intentional parse error (a backed enum without a backing type with two spaces after the colon).
// This should be the only test in the file.

enum SpaceAfterNoBackingType:  {}
