phpcs:set Universal.WhiteSpace.PrecisionAlignment ignoreAlignmentBefore[] T_COMMENT,T_FUNCTION

<?php
/**
 * Testing issue as reported upstream in
 * https://github.com/squizlabs/PHP_CodeSniffer/issues/2179#issuecomment-437634372.
 *
 * This is an issue concerning property handling across multiple files, so the
 * 19a, 19b and 19c test files together test (against) the issue.
 */

  // Bad, but not reported as token type is being ignored.
     function exampleFunctionD() {} // Bad, but not reported as token type is being ignored.
      function exampleFunctionE() {} // Bad, but not reported as token type is being ignored.
       function exampleFunctionF() {} // Bad, but not reported as token type is being ignored.
