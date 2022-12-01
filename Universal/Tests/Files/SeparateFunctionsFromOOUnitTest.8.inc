<?php

// Invalid: File which declares both named function(s) as well as OO structure(s).

enum Suit: string implements Colorful, CardGame {
    case Hearts = 'H';
    case Diamonds = 'D';
    case Clubs = 'C';
    case Spades = 'S';
}

function foo() {}
