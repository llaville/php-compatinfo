<?php

class Trait
{
    const FOO = "foo";
}

class finally
{
    function __construct()
    {
        $trait = new Trait;

        $foo = Trait::FOO;
    }
}

trait SampleTrait
{
    public static function hello()
    {
        SELF::sayHello();
    }
}
