<?php
// @link https://www.php.net/manual/en/language.oop5.magic.php#language.oop5.traits.abstract.ex1

class C {
    private $prop;

    public function __construct($val) {
        $this->prop = $val;
    }

    public function __debugInfo() {
        return [
            'propSquared' => $this->prop ** 2,
        ];
    }
}

var_dump(new C(42));
