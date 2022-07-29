<?php

/*
 * Test handling of leading whitespace in combination with heredoc/nowdoc closing identifiers.
 *
 * IMPORTANT: this needs to be a separate test case file as the PHP 7.3 style heredocs/nowdocs will
 * cause problems for the tokenized when run on PHP < 7.3, causing all code after it to be garbage tokens.
 *
 * This also means that the functionality for PHP 7.3 style heredocs/nowdocs will only work when
 * PHPCS is run on PHP 7.3+ (and same applies to the tests, this can only be tested on PHP 7.3+).
 */

/*
 * Cross-version compatible heredoc/nowdocs.
 *
 * These will always be okay.
 * The text lines are not checked and the closer MUST be at the start of the line,
 * as otherwise the code will result in a parse error.
 */

// Space indent.
$heredoc = <<<EOD
some text
      some text
  some text
EOD;

$nowdoc = <<<'EOD'
some text
      some text
  some text
EOD;

// Tab indent.
$heredoc = <<<EOD
some text
	  some text
	some text
EOD;

$nowdoc = <<<'EOD'
some text
	  some text
  some text
EOD;

/*
 * PHP >= 7.3: flexible heredoc/nowdocs.
 *
 * In this case, the indentation before the closing identifier will be checked.
 * As before, the text lines will not be checked.
 *
 * Notes:
 * - These tests also safeguard that for nowdoc/heredoc closers, the indent is always rounded DOWN
 *   as rounding up could cause a parse error (invalid body indentation level)!
 * - These tests also verify correct handling of spaces vs tabs in tokens in which PHPCS
 *   may not have done the replacement natively.
 */

// Space indent.
$heredoc = <<<END
      a
     b
    c
    END; // OK.

$nowdoc = <<<'END'
      a
     b
    c
    END; // OK.

$heredoc = <<<"END"
          a
        b
      c
     END; // Warning.

$nowdoc = <<<'END'
          a
        b
      c
     END; // Warning.

$heredoc = <<<END
          a
       b
       END; // Warning.

$nowdoc = <<<'END'
          a
       b
       END; // Warning.

// Tab indent.
$heredoc = <<<END
	  a
	 b
	c
	END; // OK.

$nowdoc = <<<'END'
	  a
	 b
	c
	END; // OK.

$heredoc = <<<"END"
		  a
		b
	  c
	 END; // Warning.

$nowdoc = <<<'END'
		  a
		b
	  c
	 END; // Warning.

$heredoc = <<<END
		  a
	   b
	   END; // Warning.

$nowdoc = <<<'END'
		  a
	   b
	   END; // Warning.
