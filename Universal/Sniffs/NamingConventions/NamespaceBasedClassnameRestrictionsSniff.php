<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2021 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Short Description.
 *
 * Long description.
 *
 * @since 1.0.0
 */
class NamespaceBasedClassnameRestrictionsSniff implements Sniff
{

    /**
     * Property description.
     *
     * ... with code sample.
     */
    public $rules = [];

//    public $include_interfaces = false;

//    public $include_traits = false;

    private $current_file;
    private $current_namespace;
    private $current_namespace_end;

    private $regexes_validated = false;

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function register()
    {
        return [
            \T_NAMESPACE,
            \T_CLASS,
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 1.0.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
//var_dump($this->rules);

        // NOTES TO SELF:
        // Just some notes about what I currently think the sniff will need to look like:

        // First time the sniff is hit only: Validate regexes
        // Set private property to indicate this check has been done.

        // Always: check if we're still in the same file, if not clear out previously remembered namespace

        // If namespace token: get namespace name, but only if namespace declaration (not operator)
        // Loop through regex patterns to see if the namespace name matches any, if not, skip to end of namespace (only scoped).

        // If class token, get classname
        // Match against matched namespace rule.
        // Throw error if no match.
    }
}
