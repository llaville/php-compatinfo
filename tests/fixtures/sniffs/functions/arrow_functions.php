<?php
class Test {
    public function method() {
        $fn = fn() => var_dump($this);
        $fn();
    }
}

(new Test())->method();  // object(Test)#1 { ... }
