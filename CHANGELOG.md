# Change Log for the PHPCSExtra standard for PHP Codesniffer

All notable changes to this project will be documented in this file.

This projects adheres to [Keep a CHANGELOG](http://keepachangelog.com/) and uses [Semantic Versioning](http://semver.org/).

**Legend**:
:wrench: = Includes auto-fixer.
:bar_chart: = Includes metrics.
:books: = Includes CLI documentation.


## [Unreleased]

_Nothing yet._

## [1.0.0-alpha3] - 2020-06-29

### Added

#### Universal

* :wrench: :books: New `Universal.Arrays.DisallowShortArraySyntax` sniff to disallow short array syntax. [#40](https://github.com/PHPCSStandards/PHPCSExtra/pull/40)
    In contrast to the PHPCS native `Generic.Arrays.DisallowShortArraySyntax` sniff, this sniff will ignore short list syntax and not cause parse errors when the fixer is used.
* :wrench: :bar_chart: :books: New `Universal.Constants.UppercaseMagicConstants` sniff to enforce that PHP native magic constants are in uppercase. [#64](https://github.com/PHPCSStandards/PHPCSExtra/pull/64)
* :bar_chart: :books: New `Universal.Namespaces.DisallowDeclarationWithoutName` sniff to disallow namespace declarations without a namespace name. [#50](https://github.com/PHPCSStandards/PHPCSExtra/pull/50)
* :bar_chart: :books: New `Universal.Operators.DisallowLogicalAndOr` sniff to enforce the use of the boolean `&&` and `||` operators instead of the logical `and`/`or` operators. [#52](https://github.com/PHPCSStandards/PHPCSExtra/pull/52)
    Note: as the [operator precedence](https://www.php.net/manual/en/language.operators.precedence.php) of the logical operators is significantly lower than the operator precedence of boolean operators, this sniff does not contain an auto-fixer.
* :bar_chart: :books: New `Universal.Operators.DisallowShortTernary` sniff to disallow the use of short ternaries `?:`. [#42](https://github.com/PHPCSStandards/PHPCSExtra/pull/42)
    While short ternaries are useful when used correctly, the principle of them is often misunderstood and they are more often than not used incorrectly, leading to hard to debug issues and/or PHP warnings/notices.
* :wrench: :bar_chart: :books: New `Universal.Operators.DisallowStandalonePostIncrementDecrement` sniff disallow the use of post-in/decrements in stand-alone statements and discourage the use of multiple increment/decrement operators in a stand-alone statement. [#65](https://github.com/PHPCSStandards/PHPCSExtra/pull/65)
* :wrench: :bar_chart: :books: New `Universal.Operators.StrictComparisons` sniff to enforce the use of strict comparisons. [#48](https://github.com/PHPCSStandards/PHPCSExtra/pull/48)
    Warning: the auto-fixer for this sniff _may_ cause bugs in applications and should be used with care! This is considered a _risky_ fixer.
* :wrench: :bar_chart: :books: New `Universal.OOStructures.AlphabeticExtendsImplements` sniff to verify that the names used in a class "implements" statement or an interface "extends" statement are listed in alphabetic order. [#55](https://github.com/PHPCSStandards/PHPCSExtra/pull/55)
    * This sniff contains a public `orderby` property to determine the sort order to use for the statement.
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
* :wrench: :bar_chart: :books: New `Universal.UseStatements.LowercaseFunctionConst` sniff to enforce that `function` and `const` keywords when used in an import `use` statement are always lowercase. [#58](https://github.com/PHPCSStandards/PHPCSExtra/pull/58)
* :wrench: :bar_chart: :books: New `Universal.UseStatements.NoLeadingBackslash` sniff to verify that a name being imported in an import `use` statement does not start with a leading backslash. [#46](https://github.com/PHPCSStandards/PHPCSExtra/pull/46)
    Names in import `use` statements should always be fully qualified, so a leading backslash is not needed and it is strongly recommended not to use one.
    This sniff handles all types of import use statements supported by PHP, in contrast to other sniffs for the same in, for instance, the PSR12 or the Slevomat standard, which are incomplete.
* :wrench: :books: New `Universal.WhiteSpace.DisallowInlineTabs` sniff to enforce using spaces for mid-line alignment. [#43](https://github.com/PHPCSStandards/PHPCSExtra/pull/43)

### Changed

#### Other
* The `master` branch has been renamed to `stable`.
* Composer: The version requirements for the [DealerDirect Composer PHPCS plugin] have been widened to allow for version 0.7.0 which supports Composer 2.0.0. [#62](https://github.com/PHPCSStandards/PHPCSExtra/pull/62)
* Various housekeeping.


## [1.0.0-alpha2] - 2020-02-18

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


[Unreleased]: https://github.com/PHPCSStandards/PHPCSExtra/compare/stable...HEAD
[1.0.0-alpha3]: https://github.com/PHPCSStandards/PHPCSExtra/compare/1.0.0-alpha2...1.0.0-alpha3
[1.0.0-alpha2]: https://github.com/PHPCSStandards/PHPCSExtra/compare/1.0.0-alpha1...1.0.0-alpha2
