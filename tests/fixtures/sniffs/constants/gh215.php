<?php

const ONE = 1;
const TWO = 2;

class C {
    const THREE = TWO + 1;

    protected $prop = self::THREE + 1;

    public function f($a = ONE + self::THREE)
    {
        return $a;
    }
}
