<?php
class MyClass {
    public static $t = 't';
    public static function test() {
            //Do something
    }
}

$name = 'MyClass';

//Following lines are supported only in PHP 5.3+
$name::test();
echo $name::$t;
