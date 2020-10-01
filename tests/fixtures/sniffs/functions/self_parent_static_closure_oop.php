<?php

class A {
    public function fn() { echo __METHOD__ . PHP_EOL; }
}

class B extends A {
    public function fn() {
        echo __METHOD__ . PHP_EOL;

        $func = function() {
            parent::fn();
        };
        $func();
    }
}

class Foo
{
    const FOO_SELF = 'self';
    const FOO_STATIC = 'static';
    const STATIC_CLOSURE = 'static_closure';

    public function testSelf()
    {
        $func = function () {
            var_dump(self::FOO_SELF);
        };
        $func();
    }


    public function testStatic()
    {
        $func = function () {
            var_dump(static::FOO_STATIC);
        };
        $func();
    }

    public function staticAnonymousFunction()
    {
        $func = static function() {
            var_dump(self::STATIC_CLOSURE);
        };
        $func();
    }
}

$foo = new Foo();

$foo->testSelf();
$foo->testStatic();
$foo->staticAnonymousFunction();

$b = new B();
$b->fn();
