<?php
namespace PHPCI;

trait Say
{
    function SayHello()
    {
        echo "Hello from " . __TRAIT__  
            . PHP_EOL
        ;
    }
}

class Foo
{
    use Say;
    
    function bar()
    {
        $this->SayHello();
        
        echo "Here we are at " . __CLASS__ .'::'. __METHOD__ 
            . ' (' . __NAMESPACE__ . ')'
            . PHP_EOL
        ;
    }
    
}

function magic_constants()
{
    echo
        "File: " . __FILE__
        . PHP_EOL
        . "Line: " . __LINE__ 
        . PHP_EOL
        . "Dir.: " . __DIR__ 
        . PHP_EOL 
        . "from function: " . __FUNCTION__ 
        . PHP_EOL
    ;
}

magic_constants();

(new Foo)->bar();
