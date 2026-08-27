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
