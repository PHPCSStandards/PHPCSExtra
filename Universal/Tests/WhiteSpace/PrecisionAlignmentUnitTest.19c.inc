<?php
/**
 * Testing issue as reported upstream in
 * https://github.com/squizlabs/PHP_CodeSniffer/issues/2179#issuecomment-437634372.
 *
 * This is an issue concerning property handling across multiple files, so the
 * 19a, 19b and 19c test files together test (against) the issue.
 *
 * This file should inherit the property settings from the 19a test case file.
 */

  // Bad, but not reported as token type is being ignored.
     function exampleFunctionD() {} // Bad, but not reported as token type is (still) being ignored.
      function exampleFunctionE() {} // Bad, but not reported as token type is (still) being ignored.
       function exampleFunctionF() {} // Bad, but not reported as token type is (still) being ignored.

// phpcs:set Universal.WhiteSpace.PrecisionAlignment ignoreAlignmentBefore[]
