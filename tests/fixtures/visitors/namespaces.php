<?php
namespace NS;

const ONE = 1;
const TWO = 2;

class C {
    const THREE = TWO + 1;

    public static $calc;

    public int $a;
    public ?string $b = 'foo';
    private C $prop;
    protected static string $static = 'default';

    public function instanceOf(): bool
    {
        return ($this->prop instanceof C);
    }

    public function f($a = ONE + self::THREE)
    {
        return $a;
    }
}

function foo() {}
