<?php
interface A {
    static function make(): A;
}

class B implements A {
    static function make(): B { // must exactly match parent; this will error
        return new B();
    }
}

function foo(): DateTime { 
    return null; // invalid
}

$foo = function (): array {
    return ["foo", "bar"];
};
