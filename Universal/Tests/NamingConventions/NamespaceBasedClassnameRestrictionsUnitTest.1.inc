<?php

// Testing the matching rules against namespaces.
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[] `^App\\Migrations`=>`^Version\d{14}\w+`,`^App\\Repositories`=>`Repository$`

namespace App\Migrations;

class Version20200101090000ItDoesThings {} // OK.

class Versions20200101090000ItDoesThings {} // Error.
class Version20200101090000I {
    function foo() {
        namespace\MyApp\Migrations\functionName();
    }
} // OK.
class Version20200101090000 {} // Error.

namespace MyApp\Migrations;

class Version20200101090000ItDoesThings {} // OK.
class Versions20200101090000ItDoesThings {} // OK.
class Version20200101090000I {} // OK.
class Version20200101090000 {} // OK.

namespace App\Repositories;

class ProductRepository {} // OK.
class Categories {} // Error.
class RepositoryProduct {} // Error.

namespace App\OtherThing;

class Version20200101090000ItDoesThings {} // OK.
class Versions20200101090000ItDoesThings {} // OK.
class Version20200101090000I {} // OK.
class Version20200101090000 {} // OK.

// Reset the property at the end of this file
// phpcs:set Universal.NamingConventions.NamespaceBasedClassnameRestrictions rules[]
