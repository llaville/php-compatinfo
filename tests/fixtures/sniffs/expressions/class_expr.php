<?php

class Example
{
    public static function doSomething()
    {
        static $first = true;

        echo 'I did it';
        if ($first) {
            $first = false;
            echo ' once';
        } else {
            echo ' again';
        }
        echo PHP_EOL;
    }
}

$method = 'doSomething';

// this works
Example::$method();

// and this works too with PHP 5.4 or greater
Example::{'doSomething'}();
