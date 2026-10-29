<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\UseStatements;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\BackCompat\Helper;

/**
 * Enforce/forbid a comma after the last import in a group use statement.
 *
 * Allows for different settings for single-line and multi-line group use statements.
 * The default settings follow PER-CS 2.0.
 *
 * Note: trailing commas in group use statements are only supported since PHP 7.2.
 * When the `php_version` configuration option is set to a PHP version below 7.2,
 * a missing comma will not be flagged.
 *
 * @link https://github.com/php-fig/per-coding-style/blob/2.0.0/spec.md#26-trailing-commas
 *
 * @since 1.6.0
 */
final class TrailingCommaSniff implements Sniff
{

    /**
     * Name of the metric.
     *
     * @since 1.6.0
     *
     * @var string
     */
    const METRIC_NAME = '%s group use - comma after last import';

    /**
     * Whether to enforce a comma after the last import in a single-line group use statement.
     *
     * Valid values:
     * - 'enforce' to always demand a comma after the last import in single-line group use statements;
     * - 'forbid'  to disallow a comma after the last import in single-line group use statements;
     * - 'skip'    to ignore single-line group use statements.
     *
     * Defaults to: 'forbid'.
     *
     * @since 1.6.0
     *
     * @var string
     */
    public $singleLine = 'forbid';

    /**
     * Whether to enforce a comma after the last import in a multi-line group use statement.
     *
     * Valid values:
     * - 'enforce' to always demand a comma after the last import in multi-line group use statements;
     * - 'forbid'  to disallow a comma after the last import in multi-line group use statements;
     * - 'skip'    to ignore multi-line group use statements.
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
     * PHP version as configured or 0 if unknown.
     *
     * @since 1.6.0
     *
     * @var int
     */
    private $phpVersion;

    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @since 1.6.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [\T_OPEN_USE_GROUP];
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

        if (isset($this->phpVersion) === false || \defined('PHP_CODESNIFFER_IN_TESTS')) {
            // Set default value to prevent this code from running every time the sniff is triggered.
            $this->phpVersion = 0;

            $phpVersion = Helper::getConfigData('php_version');
            if ($phpVersion !== null) {
                $this->phpVersion = (int) $phpVersion;
            }
        }

        $tokens      = $phpcsFile->getTokens();
        $groupOpener = $stackPtr;

        // When the group use statement is not closed, the tokenizer will retokenize the next close curly
        // anywhere in the file to T_CLOSE_USE_GROUP, so stop at the first of a selection of tokens
        // which cannot be part of a group use statement.
        $groupCloser = $phpcsFile->findNext(
            [
                \T_CLOSE_USE_GROUP,
                \T_SEMICOLON,
                \T_CLOSE_TAG,
                \T_OPEN_USE_GROUP,
                \T_OPEN_CURLY_BRACKET,
            ],
            ($groupOpener + 1)
        );
        if ($groupCloser === false || $tokens[$groupCloser]['code'] !== \T_CLOSE_USE_GROUP) {
            // Bow out: group use statement not closed (live coding or parse error).
            return;
        }

        $action          = $this->singleLine;
        $phrase          = 'single-line';
        $errorCodeSuffix = 'SingleLine';
        if ($tokens[$groupOpener]['line'] !== $tokens[$groupCloser]['line']) {
            $action          = $this->multiLine;
            $phrase          = 'multi-line';
            $errorCodeSuffix = 'MultiLine';
        }

        if ($action === 'skip') {
            // Nothing to do.
            return;
        }

        $lastNonEmpty = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($groupCloser - 1), $groupOpener, true);
        if ($lastNonEmpty === $groupOpener) {
            // Bow out: empty group use statement (parse error).
            return;
        }

        $isComma = ($tokens[$lastNonEmpty]['code'] === \T_COMMA);

        if ($isComma === true
            && $phpcsFile->findPrevious(Tokens::$emptyTokens, ($lastNonEmpty - 1), $groupOpener, true) === $groupOpener
        ) {
            // Bow out: group use statement only containing a comma (parse error).
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

                if ($this->phpVersion !== 0 && $this->phpVersion < 70200) {
                    // Trailing commas in group use statements are not supported in PHP < 7.2.
                    return;
                }

                $error     = 'There should be a comma after the last import in a %s group use statement.';
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

                $error     = 'A comma after the last import in a %s group use statement is not allowed.';
                $errorCode = 'Found' . $errorCodeSuffix;
                $data      = [$phrase];
                $fix       = $phpcsFile->addFixableError($error, $lastNonEmpty, $errorCode, $data);
                if ($fix === true) {
                    $start = $lastNonEmpty;
                    $end   = $lastNonEmpty;

                    // Make sure we're not leaving a superfluous blank line behind.
                    $prevNonWhitespace = $phpcsFile->findPrevious(
                        \T_WHITESPACE,
                        ($lastNonEmpty - 1),
                        $groupOpener,
                        true
                    );
                    $nextNonWhitespace = $phpcsFile->findNext(
                        \T_WHITESPACE,
                        ($lastNonEmpty + 1),
                        ($groupCloser + 1),
                        true
                    );

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
