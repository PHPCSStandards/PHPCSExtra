<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Enforce/forbid a comma after the last arm in a match expression.
 *
 * Allows for different settings for single-line and multi-line match expressions.
 * The default settings follow PER-CS 2.0.
 *
 * @link https://github.com/php-fig/per-coding-style/blob/2.0.0/spec.md#26-trailing-commas
 *
 * @since 1.6.0
 */
final class MatchTrailingCommaSniff implements Sniff
{

    /**
     * Name of the metric.
     *
     * @since 1.6.0
     *
     * @var string
     */
    const METRIC_NAME = '%s match - comma after last arm';

    /**
     * Whether to enforce a comma after the last arm in a single-line match expression.
     *
     * Valid values:
     * - 'enforce' to always demand a comma after the last arm in single-line match expressions;
     * - 'forbid'  to disallow a comma after the last arm in single-line match expressions;
     * - 'skip'    to ignore single-line match expressions.
     *
     * Defaults to: 'forbid'.
     *
     * @since 1.6.0
     *
     * @var string
     */
    public $singleLine = 'forbid';

    /**
     * Whether to enforce a comma after the last arm in a multi-line match expression.
     *
     * Valid values:
     * - 'enforce' to always demand a comma after the last arm in multi-line match expressions;
     * - 'forbid'  to disallow a comma after the last arm in multi-line match expressions;
     * - 'skip'    to ignore multi-line match expressions.
     *
     * Defaults to: 'enforce'.
     *
     * @since 1.6.0
     *
     * @var string
     */
    public $multiLine = 'enforce';

    /**
     * The input values to consider as valid for the public properties.
     *
     * Used for input validation.
     *
     * @since 1.6.0
     *
     * @var array<string, true>
     */
    private $validValues = [
        'enforce' => true,
        'forbid'  => true,
        'skip'    => true,
    ];

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @since 1.6.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [\T_MATCH];
    }

    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @since 1.6.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        // Validate the property input. Invalid values will result in the check being skipped.
        if (isset($this->validValues[$this->singleLine]) === false) {
            $this->singleLine = 'skip';
        }
        if (isset($this->validValues[$this->multiLine]) === false) {
            $this->multiLine = 'skip';
        }

        $tokens = $phpcsFile->getTokens();

        $opener = $tokens[$stackPtr]['scope_opener'];
        $closer = $tokens[$stackPtr]['scope_closer'];

        $action          = $this->singleLine;
        $phrase          = 'single-line';
        $errorCodeSuffix = 'SingleLine';
        if ($tokens[$opener]['line'] !== $tokens[$closer]['line']) {
            $action          = $this->multiLine;
            $phrase          = 'multi-line';
            $errorCodeSuffix = 'MultiLine';
        }

        if ($action === 'skip') {
            // Nothing to do.
            return;
        }

        $lastNonEmpty = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($closer - 1), $opener, true);
        if ($lastNonEmpty === $opener) {
            // Bow out: match expression without arms.
            return;
        }

        $isComma = ($tokens[$lastNonEmpty]['code'] === \T_COMMA);

        if ($isComma === true
            && $phpcsFile->findPrevious(Tokens::$emptyTokens, ($lastNonEmpty - 1), $opener, true) === $opener
        ) {
            // Bow out: match expression only containing a comma (parse error).
            return;
        }

        $phpcsFile->recordMetric(
            $stackPtr,
            \sprintf(self::METRIC_NAME, \ucfirst($phrase)),
            ($isComma === true ? 'yes' : 'no')
        );

        switch ($action) {
            case 'enforce':
                if ($isComma === true) {
                    return;
                }

                $error     = 'There should be a comma after the last arm in a %s match expression.';
                $errorCode = 'Missing' . $errorCodeSuffix;
                $data      = [$phrase];
                $fix       = $phpcsFile->addFixableError($error, $lastNonEmpty, $errorCode, $data);
                if ($fix === true) {
                    $phpcsFile->fixer->addContent($lastNonEmpty, ',');
                }

                return;

            case 'forbid':
                if ($isComma === false) {
                    return;
                }

                $error     = 'A comma after the last arm in a %s match expression is not allowed.';
                $errorCode = 'Found' . $errorCodeSuffix;
                $data      = [$phrase];
                $fix       = $phpcsFile->addFixableError($error, $lastNonEmpty, $errorCode, $data);
                if ($fix === true) {
                    $start = $lastNonEmpty;
                    $end   = $lastNonEmpty;

                    // Make sure we're not leaving a superfluous blank line behind.
                    $prevNonWhitespace = $phpcsFile->findPrevious(\T_WHITESPACE, ($lastNonEmpty - 1), $opener, true);
                    $nextNonWhitespace = $phpcsFile->findNext(\T_WHITESPACE, ($lastNonEmpty + 1), ($closer + 1), true);

                    if ($tokens[$prevNonWhitespace]['line'] < $tokens[$lastNonEmpty]['line']
                        && $tokens[$nextNonWhitespace]['line'] > $tokens[$lastNonEmpty]['line']
                    ) {
                        $start = ($prevNonWhitespace + 1);

                        // A single-line comment token ("//" or "#") includes the new line,
                        // so remove the new line after the comma instead.
                        if (\substr($tokens[$prevNonWhitespace]['content'], -1) === "\n") {
                            $end = ($lastNonEmpty + 1);
                        }
                    }

                    $phpcsFile->fixer->beginChangeset();

                    for ($i = $start; $i <= $end; $i++) {
                        $phpcsFile->fixer->replaceToken($i, '');
                    }

                    $phpcsFile->fixer->endChangeset();
                }

                return;
        }
    }
}
