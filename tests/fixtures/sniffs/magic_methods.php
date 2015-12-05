<?php

class Foo
{
    public function __debugInfo()
    {
    }
}

class CallableClass
{
    public function __invoke($x)
    {
        var_dump($x);
    }
}

class A
{
    public $var1;
    public $var2;

    public static function __set_state($an_array) // since PHP 5.1.0
    {
        $obj = new A;
        $obj->var1 = $an_array['var1'];
        $obj->var2 = $an_array['var2'];
        return $obj;
    }
}

$obj = new CallableClass;
$obj(5);

$a = new A;
$a->var1 = 5;
$a->var2 = 'foo';

print('$b = ' . var_export($a, true) . ';');

/*
$b = A::__set_state(array(
   'var1' => 5,
   'var2' => 'foo',
));
 */
