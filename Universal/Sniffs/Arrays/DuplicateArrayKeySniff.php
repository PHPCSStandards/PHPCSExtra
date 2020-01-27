<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2020 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\Arrays;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\AbstractSniffs\AbstractArrayDeclarationSniff;

/**
 * Detect duplicate array keys in array declarations.
 *
 * This sniff will detect duplicate keys with high precision, though any array key
 * set via a variable/constant/function call is excluded from the examination.
 *
 * @since 1.0.0
 */
class DuplicateArrayKeySniff extends AbstractArrayDeclarationSniff
{

    /**
     * Keep track of which array keys have been seen already.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $keysSeen = [];

    /**
     * Keep track of the maximum seen integer key to know what the next value will be for
     * array items without a key.
     *
     * @since 1.0.0
     *
     * @var int
     */
    private $currentMaxIntKey = -1;

    /**
     * Process every part of the array declaration.
     *
     * This contains the default logic for the sniff, but can be overloaded in a concrete child class
     * if needed.
     *
     * @since 1.0.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
     *                                               token was found.
     *
     * @return void
     */
    public function processArray(File $phpcsFile)
    {
        // Reset properties before processing this array.
        $this->keysSeen         = [];
        $this->currentMaxIntKey = -1;

        parent::processArray($phpcsFile);
    }

    /**
     * Process the tokens in an array key.
     *
     * @since 1.0.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
     *                                               token was found.
     * @param int                         $startPtr  The stack pointer to the first token in the "key" part of
     *                                               an array item.
     * @param int                         $endPtr    The stack pointer to the last token in the "key" part of
     *                                               an array item.
     * @param int                         $itemNr    Which item in the array is being handled.
     *
     * @return void
     */
    public function processKey(File $phpcsFile, $startPtr, $endPtr, $itemNr)
    {
        $key = $this->getActualArrayKey($phpcsFile, $startPtr, $endPtr);

        if (isset($key) === false) {
            // Key could not be determined.
            return;
        }

        $integerKey = \is_int($key);

        /*
         * Check if we've seen it before.
         */
        if (isset($this->keysSeen[$key]) === true) {
            $firstSeen              = $this->keysSeen[$key];
            $firstNonEmptyFirstSeen = $phpcsFile->findNext(Tokens::$emptyTokens, $firstSeen['ptr'], null, true);
            $firstNonEmpty          = $phpcsFile->findNext(Tokens::$emptyTokens, $startPtr, null, true);

            $data = [
                ($integerKey === true) ? 'integer' : 'string',
                $key,
                $this->tokens[$firstNonEmptyFirstSeen]['line'],
            ];

            $phpcsFile->addError(
                'Duplicate array key found. The value will be overwritten.'
                    . ' The %s array key "%s" was first seen on line %d',
                $firstNonEmpty,
                'Found',
                $data
            );

            return;
        }

        /*
         * Key not seen before. Add to array.
         */
        $this->keysSeen[$key] = [
            'item' => $itemNr,
            'ptr'  => $startPtr,
        ];

        if ($integerKey === true && $key > $this->currentMaxIntKey) {
            $this->currentMaxIntKey = $key;
        }
    }

    /**
     * Process an array item without an array key.
     *
     * @since 1.0.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
     *                                               token was found.
     * @param int                         $startPtr  The stack pointer to the first token in the array item,
     *                                               which in this case will be the first token of the array
     *                                               value part of the array item.
     * @param int                         $itemNr    Which item in the array is being handled.
     *
     * @return void
     */
    public function processNoKey(File $phpcsFile, $startPtr, $itemNr)
    {
        ++$this->currentMaxIntKey;
        $this->keysSeen[$this->currentMaxIntKey] = [
            'item' => $itemNr,
            'ptr'  => $startPtr,
        ];
    }
}
