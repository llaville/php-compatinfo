<?php

class Foo {
    public function bar((A&B)|null $entity) {
        return $entity;
    }
}
