<?php
#[AnAttribute(new Foo)]
class Test {
    public function __construct(
        public $prop = new Foo
    ) {}
}
