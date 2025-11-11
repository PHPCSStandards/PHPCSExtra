<?php

/*
 * Not our targets.
 * These tests are mostly safeguards against tokenizer issues in PHPCS, at this moment (3.13.4/4.0.0), these wouldn't be tokenized as T_EXIT anyway.
 */
class Mirror {
    const exit = 0;
    const die = 1;

    public $exit = 0;
    protected $die = 1;

    function exit() {}
    function die() {}

    function useMe() {
        echo self::exit;
        echo static::die;
        echo parent::exit;
        echo AnotherObject::die;
        echo $this->exit;
        echo $this->die;
        echo $this->exit();
        echo $this->die();
    }
}

// Invalid PHP, but not our concern. Not our target.
namespace\Sub\exit;
Partially\Qualified\die;
\Fully\Qualified\exit;

/*
 * OK.
 */
exit();
die();
Exit();
DIE();
\exit();
\die();
exit   ($status);
\die /*comment*/ (10);

/*
 * Bad.
 */
exit;
die;
EXIT;
Die;
\exit;
\die;
