<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\NamingConventions;

use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHPCSUtils\Tokens\Collections;
use PHPCSUtils\Utils\FunctionDeclarations;

/**
 * Verifies that parameters in function declarations do not use PHP reserved keywords.
 *
 * @link https://www.php.net/manual/en/reserved.keywords.php
 *
 * @since 1.0.0
 */
class NoReservedKeywordParameterNamesSniff implements Sniff
{

    /**
     * A list of PHP reserved keywords.
     *
     * @since 1.0.0
     *
     * @var array(string => string)
     */
    protected $reservedNames = [
        'abstract'      => true,
        'and'           => true,
        'array'         => true,
        'as'            => true,
        'break'         => true,
        'callable'      => true,
        'case'          => true,
        'catch'         => true,
        'class'         => true,
        'clone'         => true,
        'const'         => true,
        'continue'      => true,
        'declare'       => true,
        'default'       => true,
        'die'           => true,
        'do'            => true,
        'echo'          => true,
        'else'          => true,
        'elseif'        => true,
        'empty'         => true,
        'enddeclare'    => true,
        'endfor'        => true,
        'endforeach'    => true,
        'endif'         => true,
        'endswitch'     => true,
        'endwhile'      => true,
        'eval'          => true,
        'exit'          => true,
        'extends'       => true,
        'final'         => true,
        'finally'       => true,
        'fn'            => true,
        'for'           => true,
        'foreach'       => true,
        'function'      => true,
        'global'        => true,
        'goto'          => true,
        'if'            => true,
        'implements'    => true,
        'include'       => true,
        'include_once'  => true,
        'instanceof'    => true,
        'insteadof'     => true,
        'interface'     => true,
        'isset'         => true,
        'list'          => true,
        'match'         => true,
        'namespace'     => true,
        'new'           => true,
        'or'            => true,
        'print'         => true,
        'private'       => true,
        'protected'     => true,
        'public'        => true,
        'require'       => true,
        'require_once'  => true,
        'return'        => true,
        'static'        => true,
        'switch'        => true,
        'throw'         => true,
        'trait'         => true,
        'try'           => true,
        'unset'         => true,
        'use'           => true,
        'var'           => true,
        'while'         => true,
        'xor'           => true,
        'yield'         => true,
        '__CLASS__'     => true,
        '__DIR__'       => true,
        '__FILE__'      => true,
        '__FUNCTION__'  => true,
        '__LINE__'      => true,
        '__METHOD__'    => true,
        '__NAMESPACE__' => true,
        '__TRAIT__'     => true,
        'int'           => true,
        'float'         => true,
        'bool'          => true,
        'string'        => true,
        'true'          => true,
        'false'         => true,
        'null'          => true,
        'void'          => true,
        'iterable'      => true,
        'object'        => true,
        'resource'      => true,
        'mixed'         => true,
        'numeric'       => true,

        /*
         * Not reserved keywords, but equally confusing when used in the context of function calls
         * with named parameters.
         */
        'parent'        => true,
        'self'          => true,
    ];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function register()
    {
        return Collections::functionDeclarationTokensBC();
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
        $tokens    = $phpcsFile->getTokens();
        $content   = $tokens[$stackPtr]['content'];
        $contentLC = \strtolower($content);

        // Get all parameters from method signature.
        try {
            $parameters = FunctionDeclarations::getParameters($phpcsFile, $stackPtr);
            if (empty($parameters)) {
                return;
            }
        } catch (RuntimeException $e) {
            // Most likely a T_STRING which wasn't an arrow function.
            return;
        }

        $paramNames = [];
        foreach ($parameters as $param) {
            $name = \ltrim($param['name'], '$');
            if (isset($this->reservedNames[$name]) === true) {
                $phpcsFile->addWarning(
                    'It is recommended not to use reserved keywords as function parameter names. Found: %s',
                    $stackPtr,
                    $name . 'Found',
                    [$param['name']]
                );
            }
        }
    }
}
