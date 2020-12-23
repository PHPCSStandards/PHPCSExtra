PHPCSExtra
=====================================================

<div aria-hidden="true">

[![Latest Stable Version](https://poser.pugx.org/phpcsstandards/phpcsextra/v/stable)](https://packagist.org/packages/phpcsstandards/phpcsextra)
[![Release Date of the Latest Version](https://img.shields.io/github/release-date/PHPCSStandards/PHPCSExtra.svg?maxAge=1800)](https://github.com/PHPCSStandards/PHPCSExtra/releases)
:construction:
[![Latest Unstable Version](https://img.shields.io/badge/unstable-dev--develop-e68718.svg?maxAge=2419200)](https://packagist.org/packages/phpcsstandards/phpcsextra#dev-develop)
[![Last Commit to Unstable](https://img.shields.io/github/last-commit/PHPCSStandards/PHPCSExtra/develop.svg)](https://github.com/PHPCSStandards/PHPCSExtra/commits/develop)

[![Minimum PHP Version](https://img.shields.io/packagist/php-v/phpcsstandards/phpcsextra.svg?maxAge=3600)](https://packagist.org/packages/phpcsstandards/phpcsextra)
[![CS Build Status](https://github.com/PHPCSStandards/PHPCSExtra/workflows/CS/badge.svg?branch=develop)](https://github.com/PHPCSStandards/PHPCSExtra/actions?query=workflow%3ACS)
[![Test Build Status](https://github.com/PHPCSStandards/PHPCSExtra/workflows/Test/badge.svg?branch=develop)](https://github.com/PHPCSStandards/PHPCSExtra/actions?query=workflow%3ATest)
[![Tested on PHP 5.4 to 8.0](https://img.shields.io/badge/tested%20on-PHP%205.4%20|%205.5%20|%205.6%20|%207.0%20|%207.1%20|%207.2%20|%207.3%20|%207.4%20|%208.0-brightgreen.svg?maxAge=2419200)](https://github.com/PHPCSStandards/PHPCSExtra/actions?query=workflow%3ATest)
[![Coverage Status](https://coveralls.io/repos/github/PHPCSStandards/PHPCSExtra/badge.svg)](https://coveralls.io/github/PHPCSStandards/PHPCSExtra)

[![License: LGPLv3](https://poser.pugx.org/phpcsstandards/phpcsextra/license)](https://github.com/PHPCSStandards/PHPCSExtra/blob/stable/LICENSE)
![Awesome](https://img.shields.io/badge/awesome%3F-yes!-brightgreen.svg)

</div>

* [Introduction](#introduction)
* [Minimum Requirements](#minimum-requirements)
* [Installation](#installation)
    + [Composer Project-based Installation](#composer-project-based-installation)
    + [Composer Global Installation](#composer-global-installation)
* [Features](#features)
* [Sniffs](#sniffs)
    + [NormalizedArrays](#normalizedarrays)
    + [Universal](#universal)
* [Contributing](#contributing)
* [License](#license)


Introduction
-------------------------------------------

PHPCSExtra is a collection of sniffs and standards for use with [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer).


Minimum Requirements
-------------------------------------------

* PHP 5.4 or higher.
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) version **3.3.1** or higher.
* [PHPCSUtils](https://github.com/PHPCSStandards/PHPCSUtils) version **1.0.0** or higher.


Installation
-------------------------------------------

Installing via Composer is highly recommended.

[Composer](http://getcomposer.org/) will automatically install the project dependencies and register the rulesets from PHPCSExtra and other external standards with PHP_CodeSniffer using the [DealerDirect Composer PHPCS plugin](https://github.com/Dealerdirect/phpcodesniffer-composer-installer/).

### Composer Project-based Installation

Run the following from the root of your project:
```bash
composer require --dev phpcsstandards/phpcsextra:"^1.0"
```

### Composer Global Installation

Alternatively, you may want to install this standard globally:
```bash
composer global require --dev phpcsstandards/phpcsextra:"^1.0"
```


Features
-------------------------------------------

Once this project is installed, you will see two new rulesets in the list of installed standards when you run `phpcs -i`: `NormalizedArrays` and `Universal`.

* The `NormalizedArrays` ruleset is a standard to check the formatting of array declarations.
* The `Universal` ruleset is **NOT** a standard, but a sniff collection.
    It should **NOT** be included in custom rulesets as a standard as it contains contradictory rules.
    Instead include individual sniffs from this standard in a custom project/company ruleset to use them.


Sniffs
-------------------------------------------

**Legend**:
* :wrench: = Includes auto-fixer.
* :bar_chart: = Includes metrics.
* :books: = Includes CLI documentation.


### NormalizedArrays

#### `NormalizedArrays.Arrays.ArrayBraceSpacing` :wrench: :bar_chart: :books:

Enforce consistent spacing for the open/close braces of array declarations.

The sniff allows for having different settings for:
- Space between the array keyword and the open parenthesis for long arrays via the `keywordSpacing` property.
    Accepted values: (int) number of spaces or `false` to turn this check off. Defaults to `0` spaces.
- Spaces on the inside of the braces for empty arrays via the `spacesWhenEmpty` property.
    Accepted values: (string) `newline`, (int) number of spaces or `false` to turn this check off. Defaults to `0` spaces.
- Spaces on the inside of the braces for single-line arrays via the `spacesSingleLine` property;
    Accepted values: (int) number of spaces or `false` to turn this check off. Defaults to `0` spaces.
- Spaces on the inside of the braces for multi-line arrays via the `spacesMultiLine` property.
    Accepted values: (string) `newline`, (int) number of spaces or `false` to turn this check off. Defaults to `newline`.

Note: if any of the above properties are set to `newline`, it is recommended to also include an array indentation sniff. This sniff will not handle the indentation.

#### `NormalizedArrays.Arrays.CommaAfterLast` :wrench: :bar_chart: :books:

Enforce/forbid a comma after the last item in an array declaration.

By default, this sniff will:
* Forbid a comma after the last array item for single-line arrays.
* Enforce a comma after the last array item for multi-line arrays.

This can be changed for each type or array individually by setting the `singleLine` and/or `multiLine` properties in a custom ruleset.

Use any of the following values to change the properties: `enforce`, `forbid` or `skip` to not check the comma after the last array item for a particular type of array.

The default for the `singleLine` property is `forbid`. The default for the `multiLine` property is `enforce`.

### Universal

#### `Universal.Arrays.DisallowShortArraySyntax` :wrench: :books:

Disallow short array syntax.

In contrast to the PHPCS native `Generic.Arrays.DisallowShortArraySyntax` sniff, this sniff will ignore short list syntax and not cause parse errors when the fixer is used.

#### `Universal.Arrays.DuplicateArrayKey` :books:

Detects duplicate array keys in array declarations.

#### `Universal.Arrays.MixedArrayKeyTypes` :books:

Best practice sniff: don't use a mix of integer and numeric keys for array items.

#### `Universal.Arrays.MixedKeyedUnkeyedArray` :books:

Best practice sniff: don't use a mix of keyed and unkeyed array items.

#### `Universal.Constants.UppercaseMagicConstants` :wrench: :bar_chart: :books:

Enforce uppercase when using PHP native magic constants, like `__FILE__` et al.

#### `Universal.ControlStructures.DisallowAlternativeSyntax` :wrench: :bar_chart: :books:

Disallow using the alternative syntax for control structures.

* This sniff contains an `allowWithInlineHTML` property to allow alternative syntax when inline HTML is used within the control structure. In all other cases, the use of the alternative syntax will still be disallowed.
    Acceped values: (bool) `true`|`false`. Defaults to `false`.
* The sniff has modular error codes to allow for making exceptions based on specific control structures and/or specific control structures in combination with inline HTML.
    The error codes follow the following pattern: `Found[ControlStructure][WithInlineHTML]`. Examples: `FoundIf`, `FoundSwitchWithInlineHTML`.

#### `Universal.ControlStructures.IfElseDeclaration` :wrench: :bar_chart: :books:

Verify that else(if) statements with braces are on a new line.

#### `Universal.Lists.DisallowLongListSyntax` :wrench: :bar_chart: :books:

Disallow the use of long `list`s.

#### `Universal.Lists.DisallowShortListSyntax` :wrench: :bar_chart: :books:

Disallow the use of short lists.

#### `Universal.Namespaces.DisallowDeclarationWithoutName` :bar_chart: :books:

Disallow namespace declarations without a namespace name.

This sniff only applies to namespace declarations using the curly brace syntax.

#### `Universal.Namespaces.DisallowCurlyBraceSyntax` :bar_chart: :books:

Disallow the use of the alternative namespace declaration syntax using curly braces.

#### `Universal.Namespaces.EnforceCurlyBraceSyntax` :bar_chart: :books:

Enforce the use of the alternative namespace syntax using curly braces.

#### `Universal.Namespaces.OneDeclarationPerFile` :books:

Disallow the use of multiple namespaces within a file.

#### `Universal.OOStructures.AlphabeticExtendsImplements` :wrench: :bar_chart: :books:

Enforce that the names used in a class "implements" statement or an interface "extends" statement are listed in alphabetic order.

* This sniff contains a `orderby` property to determine the sort order to use for the statement.
    If all names used are unqualified, the sort order won't make a difference.
    However, if one or more of the names are partially or fully qualified, the chosen sort order will determine how the sorting between unqualified, partially and fully qualified names is handled.
    The sniff supports two sort order options:
    - _'name'_ : sort by the interface name only (default);
    - _'full'_ : sort by the full name as used in the statement (without leading backslash).
    In both cases, the sorting will be done using natural sort, case-insensitive.
* The sniff has modular error codes to allow for selective inclusion/exclusion:
    - `ImplementsWrongOrder` - for "class implements" statements.
    - `ImplementsWrongOrderWithComments` - for "class implements" statements interlaced with comments. These will not be auto-fixed.
    - `ExtendsWrongOrder` - for "interface extends" statements.
    - `ExtendsWrongOrderWithComments` - for "interface extends" statements interlaced with comments. These will not be auto-fixed.
* When fixing, the existing spacing between the names in an `implements`/`extends` statement will not be maintained.
    The fixer will separate each name with a comma and one space.
    If alternative formatting is desired, a sniff which will check and fix the formatting should be added to the ruleset.

#### `Universal.Operators.DisallowLogicalAndOr` :bar_chart: :books:

Enforce the use of the boolean `&&` and `||` operators instead of the logical `and`/`or` operators.

:information_source: Note: as the [operator precedence](https://www.php.net/manual/en/language.operators.precedence.php) of the logical operators is significantly lower than the operator precedence of boolean operators, this sniff does not contain an auto-fixer.

#### `Universal.Operators.DisallowShortTernary` :bar_chart: :books:

Disallow the use of short ternaries `?:`.

While short ternaries are useful when used correctly, the principle of them is often misunderstood and they are more often than not used incorrectly, leading to hard to debug issues and/or PHP warnings/notices.

#### `Universal.Operators.DisallowStandalonePostIncrementDecrement` :wrench: :bar_chart: :books:

* Disallow the use of post-in/decrements in stand-alone statements - error codes: `PostDecrementFound` and `PostIncrementFound`.
    Using pre-in/decrement is more in line with the principle of least astonishment and prevents bugs when code gets moved around at a later point in time.
* Discourages the use of multiple increment/decrement operators in a stand-alone statement - error code: `MultipleOperatorsFound`.

#### `Universal.Operators.StrictComparisons` :wrench: :bar_chart: :books:

Enforce the use of strict comparisons.

:warning: **Warning**: the auto-fixer for this sniff _may_ cause bugs in applications and should be used with care!
This is considered a **_risky_ fixer**.

#### `Universal.UseStatements.DisallowUseClass` :bar_chart: :books:

Forbid using import `use` statements for classes/traits/interfaces.

Individual sub-types - with/without alias, global imports, imports from the same namespace - can be forbidden by including that specific error code and/or allowed including the whole sniff and excluding specific error codes.

The available error codes are: `FoundWithoutAlias`, `FoundWithAlias`, `FromGlobalNamespace`, `FromGlobalNamespaceWithAlias`, `FromSameNamespace` and `FromSameNamespaceWithAlias`.

#### `Universal.UseStatements.DisallowUseConst` :bar_chart: :books:

Forbid using import `use` statements for constants.

See [`Universal.UseStatements.DisallowUseClass`](#universalusestatementsdisallowuseclass-bar_chart-books) for information on the error codes.

#### `Universal.UseStatements.DisallowUseFunction` :bar_chart: :books:

Forbid using import `use` statements for functions.

See [`Universal.UseStatements.DisallowUseClass`](#universalusestatementsdisallowuseclass-bar_chart-books)  for information on the error codes.

#### `Universal.UseStatements.LowercaseFunctionConst` :wrench: :bar_chart: :books:

Enforce that `function` and `const` keywords when used in an import `use` statement are always lowercase.

Companion sniff to the PHPCS native `Generic.PHP.LowerCaseKeyword` sniff which doesn't cover these keywords when used in an import `use` statement.

#### `Universal.UseStatements.NoLeadingBackslash` :wrench: :bar_chart: :books:

Verify that a name being imported in an import `use` statement does not start with a leading backslash.

Names in import `use` statements should always be fully qualified, so a leading backslash is not needed and it is strongly recommended not to use one.

This sniff handles all types of import use statements supported by PHP, in contrast to other sniffs for the same in, for instance, the PHPCS native `PSR12` or the Slevomat standard, which are incomplete.

#### `Universal.WhiteSpace.DisallowInlineTabs` :wrench: :books:

Enforce using spaces for mid-line alignment.

While tab versus space based indentation is a question of preference, for mid-line alignment, spaces should always be preferred, as using tabs will result in inconsistent formatting depending on the dev-user's chosen tab width.

> _This sniff is especially useful for tab-indentation based standards which use the `Generic.Whitespace.DisallowSpaceIndent` sniff to enforce this._
>
> **DO** make sure to set the PHPCS native `tab-width` configuration for the best results.
> ```xml
>    <arg name="tab-width" value="4"/>
> ```
>
> The PHPCS native `Generic.Whitespace.DisallowTabIndent` sniff (used for space-based standards) oversteps its reach and silently does mid-line tab to space replacements as well.
> However, the sister-sniff `Generic.Whitespace.DisallowSpaceIndent` leaves mid-line tabs/spaces alone.
> This sniff fills that gap.


Contributing
-------
Contributions to this project are welcome. Clone the repo, branch off from `develop`, make your changes, commit them and send in a pull request.

If unsure whether the changes you are proposing would be welcome, open an issue first to discuss your proposal.

License
-------
This code is released under the GNU Lesser General Public License (LGPLv3). For more information, visit http://www.gnu.org/copyleft/lesser.html
