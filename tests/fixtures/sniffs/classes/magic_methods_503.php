<?php
// @link https://www.php.net/manual/en/language.oop5.overloading.php#language.oop5.interfaces.examples.ex3

class MethodTest
{
    public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling object method '$name' "
            . implode(', ', $arguments). PHP_EOL;
    }

    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling static method '$name' "
            . implode(', ', $arguments). PHP_EOL;
    }
}
