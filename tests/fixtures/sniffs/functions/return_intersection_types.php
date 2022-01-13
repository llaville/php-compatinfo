<?php
class A {
    public function test(): Foo {}
}
class B extends A {
    public function test(): Foo&Bar {}
}
