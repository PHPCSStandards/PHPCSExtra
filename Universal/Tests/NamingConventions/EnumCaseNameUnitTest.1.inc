<?php

/*
 * Valid enum case names (PascalCase).
 */

enum ValidCaseNames {
    case Hearts;
    case DiamondsRed;
    case Base64Url;
    case /* comment */ Spades;
    case
        // Name on the next line.
        Clubs;
}

enum ValidBackedEnum: string {
    case A = 'A';
}

/*
 * Invalid enum case names.
 */

enum InvalidCaseNames {
    case diamondsRed;
    case diamonds_red;
    case HEARTS;
    case
        // Name on the next line.
        Base64URL;
}

enum InvalidBackedEnum: int {
    case _Hidden = 2;
}

/*
 * Allowing consecutive uppercase letters.
 */

// phpcs:set Universal.NamingConventions.EnumCaseName allowConsecutiveCaps true

enum ValidWithConsecutiveCaps {
    case JSONValue;
    case Base64URL;
    case HEARTS;
}

enum InvalidWithConsecutiveCaps {
    case diamondsRed;
    case DIAMONDS_RED;
}

// Reset to the default value.
// phpcs:set Universal.NamingConventions.EnumCaseName allowConsecutiveCaps false
