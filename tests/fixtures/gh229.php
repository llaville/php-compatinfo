<?php

class Foo
{
    private $bar = 42;

    public function baz()
    {
        $qux = function () {
            echo $this->bar;
        };
        $qux();
    }
}

$foo = new Foo;
$foo->baz();
