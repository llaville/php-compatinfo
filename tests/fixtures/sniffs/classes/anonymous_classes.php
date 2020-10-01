<?php
interface Page {
    static function make();
}

class Foo {}

trait Bar {
    public function someMethod() {
      return "bar";
    }
}

return new class($controller) implements Page {
    public function __construct($controller) {
    }

    public static function make() {
    }
};

$child = new class extends Foo {};

$anonClass = new class {
    use Bar;
};
