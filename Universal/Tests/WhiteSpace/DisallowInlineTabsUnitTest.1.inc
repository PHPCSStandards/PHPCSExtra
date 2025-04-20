<?php

/**
 * @param int    $var    Description.
 * @param string $string Another description.
 */

			$expected = ( $column - 1 );
			$found    = ( $this->tokens[ $closer ]['column'] - 1 );
			$error    = 'Array closer not aligned correctly; expected %s space(s) but found %s';
			$data     = array(
				$expected_value => 'data',
				$found          => 'more_data',
			);

/**
 * @param int	 $var	 Description - Bad: alignment using tabs.
 * @param string $string Another description.
 */

			$expected = ( $column - 1 );
			$found	  = ( $this->tokens[ $closer ]['column'] - 1 ); // Bad.
			$error	  = 'Array closer not aligned correctly; expected %s space(s) but found %s'; // Bad.
			$data	  = array( // Bad.
				$expected_value => 'data',
				$found			=> 'more_data', // Bad.
			);

/*
 * Test that the tab replacements do not negatively influence existing mid-line alignments.
 */
$a		  = true;
$aa		  = true;
$aaa	  = true;
$aaaa	  = true;
$aaaaa	  = true;
$aaaaaa	  = true;
$aaaaaaa  = true;
$aaaaaaaa = true;

// Test tab replacement	in	inline comments.

	/**
	 * @param	int		$var	Description.
	 * @param	string	$string	Another description.
	 */

		/*
		 * Tab indented		and inline tabs.
		 */

		// Tab indented		and inline tabs.
		// Tab indented		and inline tabs.

		/*
		 * @phpcs:ignore Stnd.Cat.SniffName -- testing mixed comment + annotations don't trigger on indentation.
		 */

		// Tab indented, no tabs.
		// phpcs:ignore Stnd.Cat.SniffName -- testing mixed comment + annotations don't trigger on indentation.
		// Tab indented, no tabs.

$a = <<<	TAB_BETWEEN
text
TAB_BETWEEN;

$a = <<<		'TABS_BETWEEN'
text
TABS_BETWEEN;

function myGenerator() {
	yield		from tabsBetweenShouldBeFixed();

yield	/*comment*/		from tabsBetweenShouldBeFixedEvenWhenKeywordStartsOnColumn1();

	yield
	from tabIndentationShouldBeIgnored();

	yield
	/*comment*/
	from tabIndentationShouldBeIgnored();
}
