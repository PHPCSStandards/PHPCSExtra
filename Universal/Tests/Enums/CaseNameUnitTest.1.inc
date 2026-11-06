<?php

/*
 * Valid enum case names (PascalCase).
 */

enum ValidCaseNames {
    case Hearts;
    case DiamondsRed;
    case Base64Url;
    case JsonValue;
    case /* comment */ Spades;
    case
        // Name on the next line.
        Clubs;
}

enum ValidBackedEnum: string {
    case A = 'A';
}

/*
 * Invalid enum case names: not in PascalCase.
 */

enum NotPascalCase {
    case diamondsRed;
    case diamonds_red;
    case Diamonds_Red;
    case
        // Name on the next line.
        diamondsred;
}

enum NotPascalCaseBackedEnum: int {
    case _Hidden = 2;
}

/*
 * Invalid enum case names: consecutive uppercase letters.
 */

enum HasConsecutiveCaps {
    case HEARTS;
    case JSONValue;
    case InvalidPHPName;
    case Base64URL;
}

/*
 * Invalid enum case names: both not in PascalCase and consecutive uppercase letters.
 */

enum NotPascalCaseAndHasConsecutiveCaps {
    case invalidPHPName;
    case Invalid_PHP_Name;
}
