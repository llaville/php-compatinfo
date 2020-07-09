<?php
namespace Name\Space {
    function foo() {
        return 2**3;
    }
    var_dump (2**4);  // 16
    foo ();
}
namespace {
    function baz($a = 2**4) {
        return $a;
    }
    function bar() {
        $x = 2;
        $x **= 3;
        return $x;
    }
    echo bar() . PHP_EOL;  // 8
}
