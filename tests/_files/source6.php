<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'source6-includes.php';

class Test {
    use A, B {
        B::hello insteadof A;
        A::hello as helloA;        
    }
}

$test = new Test;
$test->hello();
$test->helloA();
