PHPCSExtra
=====================================================

<div aria-hidden="true">

[![Latest Stable Version](https://poser.pugx.org/phpcsstandards/phpcsextra/v/stable)](https://packagist.org/packages/phpcsstandards/phpcsextra)
[![Travis Build Status](https://travis-ci.com/PHPCSStandards/PHPCSExtra.svg?branch=master)](https://travis-ci.com/PHPCSStandards/PHPCSExtra/branches)
[![Release Date of the Latest Version](https://img.shields.io/github/release-date/PHPCSStandards/PHPCSExtra.svg?maxAge=1800)](https://github.com/PHPCSStandards/PHPCSExtra/releases)
:construction:
[![Latest Unstable Version](https://img.shields.io/badge/unstable-dev--develop-e68718.svg?maxAge=2419200)](https://packagist.org/packages/phpcsstandards/phpcsextra#dev-develop)
[![Travis Build Status](https://travis-ci.com/PHPCSStandards/PHPCSExtra.svg?branch=develop)](https://travis-ci.com/PHPCSStandards/PHPCSExtra/branches)
[![Last Commit to Unstable](https://img.shields.io/github/last-commit/PHPCSStandards/PHPCSExtra/develop.svg)](https://github.com/PHPCSStandards/PHPCSExtra/commits/develop)

[![Minimum PHP Version](https://img.shields.io/packagist/php-v/phpcsstandards/phpcsextra.svg?maxAge=3600)](https://packagist.org/packages/phpcsstandards/phpcsextra)
[![Tested on PHP 5.4 to 7.4](https://img.shields.io/badge/tested%20on-PHP%205.4%20|%205.5%20|%205.6%20|%207.0%20|%207.1%20|%207.2%20|%207.3%20|%207.4-brightgreen.svg?maxAge=2419200)](https://travis-ci.com/PHPCSStandards/PHPCSExtra)

[![License: LGPLv3](https://poser.pugx.org/phpcsstandards/phpcsextra/license)](https://github.com/PHPCSStandards/PHPCSExtra/blob/master/LICENSE)
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

This can be changed for each type or array individually by setting the `singleLine` or `multiLine` properties in a custom ruleset.

Use any of the following values to change the properties: `enforce`, `forbid` or `skip` to not check the comma after the last array item for a particular type of array.


### Universal

#### `Universal.Arrays.DuplicateArrayKey` :books:

Detects duplicate array keys in array declarations.

#### `Universal.Arrays.MixedArrayKeyTypes` :books:

Best practice sniff: don't use a mix of integer and numeric keys for array items.

#### `Universal.Arrays.MixedKeyedUnkeyedArray` :books:

Best practice sniff: don't use a mix of keyed and unkeyed array items.

#### `Universal.ControlStructures.DisallowAlternativeSyntax` :wrench: :bar_chart: :books:

Disallow using the alternative syntax for control structures.

* This sniff contains a `allowWithInlineHTML` property to allow alternative syntax when inline HTML is used within the control structure. In all other cases, the use of the alternative syntax will still be disallowed.
* The sniff has modular error codes to allow for making exceptions based on specific control structures and/or specific control structures in combination with inline HTML.

#### `Universal.ControlStructures.IfElseDeclaration` :wrench: :bar_chart: :books:

Verify that else(if) statements with braces are on a new line.

#### `Universal.Lists.DisallowLongListSyntax` :wrench: :bar_chart: :books:

Disallow the use of long `list`s.

#### `Universal.Lists.DisallowShortListSyntax` :wrench: :bar_chart: :books:

Disallow the use of short lists.

#### `Universal.Namespaces.DisallowCurlyBraceSyntax` :bar_chart: :books:

Disallow the use of the alternative namespace declaration syntax using curly braces.

#### `Universal.Namespaces.EnforceCurlyBraceSyntax` :bar_chart: :books:

Enforce the use of the alternative namespace syntax using curly braces.

#### `Universal.Namespaces.OneDeclarationPerFile` :books:

Disallow the use of multiple namespaces within a file.

#### `Universal.UseStatements.DisallowUseClass` :bar_chart: :books:

Forbid using import `use` statements for classes/traits/interfaces.

Individual sub-types - with/without alias, global imports, imports from the same namespace - can be forbidden by just including that specific error code and/or allowed including the whole sniff and excluding specific error codes.

#### `Universal.UseStatements.DisallowUseConst` :bar_chart: :books:

Forbid using import `use` statements for constants.

Individual sub-types - with/without alias, global imports, imports from the same namespace - can be forbidden by just including that specific error code and/or allowed including the whole sniff and excluding specific error codes.

#### `Universal.UseStatements.DisallowUseFunction` :bar_chart: :books:

Forbid using import `use` statements for functions.

Individual sub-types - with/without alias, global imports, imports from the same namespace - can be forbidden by just including that specific error code and/or allowed including the whole sniff and excluding specific error codes.



Contributing
-------
Contributions to this project are welcome. Clone the repo, branch off from `develop`, make your changes, commit them and send in a pull request.

If unsure whether the changes you are proposing would be welcome, open an issue first to discuss your proposal.

License
-------
This code is released under the GNU Lesser General Public License (LGPLv3). For more information, visit http://www.gnu.org/copyleft/lesser.html
