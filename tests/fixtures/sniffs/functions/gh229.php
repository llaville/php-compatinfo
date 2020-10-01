<?php

class Foo
{
    private $bar = 42;

    public function baz()
    {
        $qux = function () {
            echo $this->bar . PHP_EOL;
        };
        $qux();
    }
}

$foo = new Foo;
$foo->baz();  // output: 42
