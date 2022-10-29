<?php

/*
 * Not our targets, no keyword possible.
 * Includes some safeguarding against potential tokenizer issues.
 */
namespace Foo\class\bar;
interface Foo {}
$a = new class() {
    public function class() {}
};
echo MyName::class;
function_call(class: $var);

/*
 * OK, no or single keyword, no ordering needed.
 */
class NoModifiers {}

final class OnlyFinal {}
abstract class OnlyAbstract extends Something {}
readonly class OnlyReadonly {}

/*
 * Ignore, compile errors, not our concern.
 */
final abstract class FinalAbstract {}

readonly final abstract class ReadonlyFinalAbstract {}
final readonly abstract class FinalReadonlyAbstract {}
abstract readonly final class AbstractReadonlyFinal {}

/*
 * OK, expected order with default settings.
 */
#[SomeAttribute]
final readonly class FinalReadonlyA {}

abstract /*comment*/ readonly class AbstractReadonlyA implements MyInterface {}

/*
 * Bad with default settings.
 */
readonly final class ReadonlyFinalA {}

ReadOnly Abstract class ReadonlyAbstractA extends Something {}

readonly
    // comment
    final


    // phpcs:ignore Stdn.Cat.SniffName -- for reasons.
    class ReadonlyFinalB implements MyInterface {}

readonly abstract /*comment*/ class ReadonlyAbstractB {}


// phpcs:set Universal.Classes.ModifierKeywordOrder order readonly extendability

/*
 * OK, expected order with custom settings.
 */
readonly final class ReadonlyFinalC {}

readonly abstract class ReadonlyAbstractC extends Something {}

/*
 * Bad with custom settings.
 */
FINAL readonly class FinalReadonlyB extends KeywordCaseShouldBeUnchanged {}

abstract readonly class AbstractReadonlyB {}


// phpcs:set Universal.Classes.ModifierKeywordOrder order readonly extends

/*
 * OK, expected order with invalid settings (default is used).
 */
abstract readonly class AbstractReadonlyC implements MyInterface {}

/*
 * Bad with invalid settings (default is used).
 */
readonly final class ReadonlyFinalD {}

// Reset to default.
// phpcs:set Universal.Classes.ModifierKeywordOrder order extendability readonly


// Live coding. Ignore. This must be the last test in the file.
class LiveCoding
