<?php
class MyClass {
    public static $t = 't';
}

$name = 'MyClass';

//Following line is supported only in PHP 5.3+
echo $name::$t;
