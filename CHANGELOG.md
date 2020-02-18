# Change Log for the PHPCSExtra standard for PHP Codesniffer

All notable changes to this project will be documented in this file.

This projects adheres to [Keep a CHANGELOG](http://keepachangelog.com/) and uses [Semantic Versioning](http://semver.org/).

**Legend**:
:wrench: = Includes auto-fixer.
:bar_chart: = Includes metrics.
:books: = Includes CLI documentation.


## [Unreleased]

_Nothing yet._


## 1.0.0-alpha2 - 2020-02-18

### Added

#### Universal
* :wrench: :bar_chart: :books: New `Universal.ControlStructures.DisallowAlternativeSyntax` sniff to disallow using the alternative syntax for control structures. [#23](https://github.com/PHPCSStandards/PHPCSExtra/pull/23)
    - This sniff contains a `allowWithInlineHTML` property to allow alternative syntax when inline HTML is used within the control structure. In all other cases, the use of the alternative syntax will still be disallowed.
    - The sniff has modular error codes to allow for making exceptions based on specific control structures and/or specific control structures in combination with inline HTML.
* :bar_chart: `Universal.UseStatements.DisallowUseClass/Function/Const`: new, additional metrics about the import source will be shown in the `info` report. [#25](https://github.com/PHPCSStandards/PHPCSExtra/pull/25)

#### Other
* Readme: installation instructions and sniff list. [#26](https://github.com/PHPCSStandards/PHPCSExtra/pull/26)

### Changed

#### Universal
* `Universal.Arrays.DuplicateArrayKey`: wording of the error message. [#18](https://github.com/PHPCSStandards/PHPCSExtra/pull/18)
* `Universal.UseStatements.DisallowUseClass/Function/Const`: the error codes have been made more modular. [#25](https://github.com/PHPCSStandards/PHPCSExtra/pull/25)
    Each of these sniffs now has four additional error codes:
    <ul>
        <li><code>FoundSameNamespace</code>, <code>FoundSameNamespaceWithAlias</code> for <code>use</code> statements importing from the same namespace;</li>
        <li><code>FoundGlobalNamespace</code>, <code>FoundGlobalNamespaceWithAlias</code> for <code>use</code> statements importing from the global namespace, like import statements for PHP native classes, functions and constants.</li>
    </ul>
    In all other circumstances, the existing error codes <code>FoundWithAlias</code> and <code>FoundWithoutAlias</code> will continue to be used.

#### Other
* Improved formatting of the CLI documentation which can be viewed using `--generator=text`. [#17](https://github.com/PHPCSStandards/PHPCSExtra/pull/17)
* Various housekeeping.

### Fixed

#### Universal
* `Universal.Arrays.DuplicateArrayKey`: improved handling of parse errors. [#34](https://github.com/PHPCSStandards/PHPCSExtra/pull/34)
* `Universal.ControlStructures.IfElseDeclaration`: the fixer will now respect tab indentation. [#19](https://github.com/PHPCSStandards/PHPCSExtra/pull/19)
* `Universal.UseStatements.DisallowUseClass/Function/Const`: the determination of whether a import is aliased in now done in a case-insensitive manner. [#25](https://github.com/PHPCSStandards/PHPCSExtra/pull/25)
* `Universal.UseStatements.DisallowUseClass/Function/Const`: an import from the global namespace would previously always be seen as non-aliased, even when it was aliased. [#25](https://github.com/PHPCSStandards/PHPCSExtra/pull/25)
* `Universal.UseStatements.DisallowUseClass/Function/Const`: improved tolerance for `use` import statements with leading backslashes. [#25](https://github.com/PHPCSStandards/PHPCSExtra/pull/25)


## 1.0.0-alpha1 - 2020-01-23

Initial alpha release containing:
* A `NormalizedArrays` standard which will contain a full set of sniffs to check the formatting of array declarations.
* A `Universal` standard which will contain a collection of universal sniffs.
    DO NOT INCLUDE THIS AS A STANDARD.
    `Universal`, like the upstream PHPCS `Generic` standard, contains sniffs which contradict each other.
    Include individual sniffs from this standard in a custom project/company ruleset to use them.

This initial alpha release contains the following sniffs:

### NormalizedArrays
* :wrench: :bar_chart: :books: `NormalizedArrays.Arrays.ArrayBraceSpacing`: enforce consistent spacing for the open/close braces of array declarations.
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
* :wrench: :bar_chart: :books: `NormalizedArrays.Arrays.CommaAfterLast`: enforce/forbid a comma after the last item in an array declaration.
    By default, this sniff will:
    <ul>
        <li>forbid a comma after the last array item for single-line arrays.</li>
        <li>enforce a comma after the last array item for multi-line arrays.</li>
    </ul>
    This can be changed for each type or array individually by setting the <code>singleLine</code> or <code>multiLine</code> properties in a custom ruleset.
    The valid values are: <code>enforce</code>, <code>forbid</code> or <code>skip</code> to not check the comma after the last array item for a particular type of array.

### Universal
* :books: `Universal.Arrays.DuplicateArrayKey`: detects duplicate array keys in array declarations.
* :books: `Universal.Arrays.MixedArrayKeyTypes`: best practice sniff: don't use a mix of integer and numeric keys for array items.
* :books: `Universal.Arrays.MixedKeyedUnkeyedArray`: best practice sniff: don't use a mix of keyed and unkeyed array items.
* :wrench: :bar_chart: :books: `Universal.ControlStructures.IfElseDeclaration`: verify that else(if) statements with braces are on a new line.
* :wrench: :bar_chart: :books: `Universal.Lists.DisallowLongListSyntax`: disallow the use of long `list`s.
* :wrench: :bar_chart: :books: `Universal.Lists.DisallowShortListSyntax`: disallow the use of short lists.
* :bar_chart: :books: `Universal.Namespaces.DisallowCurlyBraceSyntax`: disallow the use of the alternative namespace declaration syntax using curly braces.
* :bar_chart: :books: `Universal.Namespaces.EnforceCurlyBraceSyntax`: enforce the use of the alternative namespace syntax using curly braces.
* :books: `Universal.Namespaces.OneDeclarationPerFile`: disallow the use of multiple namespaces within a file.
* :bar_chart: :books: `Universal.UseStatements.DisallowUseClass`: forbid using import use statements for classes/traits/interfaces.
    Individual sub-types can be allowed by excluding specific error codes.
* :bar_chart: :books: `Universal.UseStatements.DisallowUseConst`: forbid using import use statements for constants.
    Individual sub-types can be allowed by excluding specific error codes.
* :bar_chart: :books: `Universal.UseStatements.DisallowUseFunction`: forbid using import use statements for functions.
    Individual sub-types can be allowed by excluding specific error codes.


[Unreleased]: https://github.com/PHPCSStandards/PHPCSExtra/compare/1.0.0-alpha2...HEAD
[1.0.0-alpha2]: https://github.com/PHPCSStandards/PHPCSExtra/compare/1.0.0-alpha1...1.0.0-alpha2
