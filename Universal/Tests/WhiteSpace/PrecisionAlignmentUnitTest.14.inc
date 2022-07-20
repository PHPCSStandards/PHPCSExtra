phpcs:set Universal.WhiteSpace.PrecisionAlignment ignoreAlignmentBefore[] T_FUNCTION,T_OBJECT_OPERATOR,T_OPEN_TAG

<?php
/*
 * File with space based indentation, testing the ignoreAlignmentBefore property.
 */

    function exampleFunctionA() {} // OK: [4 spaces].

/*
 * OK: sets of four spaces.
 */
        function exampleFunctionB() {}

/*
 * OK: sets of four spaces.
 */
            function exampleFunctionC() {}

    /**
     * OK: Doc comment is indented with 4 spaces + one space for the star alignment.
     *
      * @var string  <= Warning.
     * @access private
     */

    /*
        OK: Multi-line comment is indented with 4 spaces + 4 spaces for the text alignment.
     <= Warning, no star, but also not indented by multiples of 4 spaces.
        OK: Another line of text.
     */

    /*
     * OK: Multi-line comment is indented with 4 spaces + one space for the star alignment.
     *
       * <= Warning.
     */

     function exampleFunctionD() {}   // Ignored.
      function exampleFunctionE() {}  // Ignored.
       function exampleFunctionF() {} // Ignored.

    $object->functioncall()
        -> chained()
        -> anothermethod();

    $object->functioncall()
           -> chained()        // Ignored.
           -> anothermethod(); // Ignored.

   ?> <!-- Warning: three spaces. -->

    <p>
      Warning: Some inline HTML with precision alignment.
    </p>

 <?php // Ignored.

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
      alert('bad'); <!-- Warning. -->
</script>

<?php

// phpcs:set Universal.WhiteSpace.PrecisionAlignment ignoreAlignmentBefore[]
