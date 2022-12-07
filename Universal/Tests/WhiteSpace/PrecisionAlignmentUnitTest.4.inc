phpcs:set Universal.WhiteSpace.PrecisionAlignment indent 2

<?php
/*
 * File with space based indentation.
 * Using an explicit custom indent value of 2 spaces.
 */
    function exampleFunctionA() {} // OK: [2 spaces][2 spaces].

/*
 * OK: sets of two spaces.
 */
        function exampleFunctionB() {}

/*
 * OK: sets of two spaces.
 */
            function exampleFunctionC() {}

    /**
     * OK: Doc comment is indented with 4 spaces + one space for the star alignment.
     *
      * @var string  <= NO Warning as this is still a multiple of 2.
     * @access private
     */

    /*
        OK: Multi-line comment is indented with 4 spaces + 4 spaces for the text alignment.
     <= Warning, no star, but also not indented by multiples of 2 spaces.
        OK: Another line of text.
     */

    /*
     * OK: Multi-line comment is indented with 4 spaces + one space for the star alignment.
     *
       * <= NO Warning as this is still a multiple of 2 (plus 1 space for the star).
     */

     function exampleFunctionD() {}   // Warning: [2 spaces][2 spaces][extra space].
       function exampleFunctionE() {}  // Warning: [2 spaces][2 spaces][2 spaces][extra space].
         function exampleFunctionF() {} // Warning: [2 spaces][2 spaces][2 spaces][2 spaces][extra space].

  $object->functioncall()
    -> chained()
    -> anothermethod();

  $object->functioncall()
         -> chained()        // Warning: [2 spaces][2 spaces][2 spaces][2 spaces][extra space].
         -> anothermethod(); // Warning: [2 spaces][2 spaces][2 spaces][2 spaces][extra space].

   ?> <!-- Warning: three spaces. -->

    <p>
     Warning: Some inline HTML with precision alignment.
    </p>

 <?php // Warning: one space.

// Testing empty line within a comment.
/*

*/

// Testing that incorrectly aligned docblocks and multi-line inline comments do not trigger errors.
// The incorrectly star alignment is not the concern of this sniff.
    /**
    * Provision some options
    */

    /*
    * Provision some options
    */

?>

<script type="text/javascript">
    /*
     * Multi-line javascript comment should not trigger this sniff.
     */
    alert('OK');
     alert('bad');	<!-- Warning. -->
</script>

<?php

// phpcs:set Universal.WhiteSpace.PrecisionAlignment indent
