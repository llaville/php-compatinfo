<?php

class Foo
{
    protected $oo;

    private function __get($a) {}

    protected function oh()
    {
        return SELF::$oo;
    }

    public function __call($name, $arguments) {}
}

class Bar
{
    public static function __get($a) {}

    public function __toString($a) {}
}

function baz($_GET, $_POST) {}

$argCount = func_num_args();

$HTTP_BAR_VARS = 'bar';

$foo = new Foo();
$foo->oh();

while (true) {
    break;
    break 1;
    break $a;
    break 0;
    break 1 + 1;

    continue;
    continue 1;
    continue $a;
    continue 0;
    continue 1 + 1;
}


