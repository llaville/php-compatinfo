<?php

class a {
  protected $foo;
}

$ref = new ReflectionClass('a');
$inst = $ref->newInstanceWithoutConstructor();

print_r($inst);
