<?php
trait A
{
    function hello() 
    {
        echo 'Said hello from trait A';
        echo PHP_EOL;
    }
}

trait B
{
    function hello() 
    {
        echo 'Said hello from trait B';
        echo PHP_EOL;
    }
}
