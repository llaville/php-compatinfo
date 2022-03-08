<?php
class MyClass {
    public static function test() {
        //Do something
    }
}

$name = 'MyClass';

//Following line is supported only in PHP 5.3+
$name::test();
