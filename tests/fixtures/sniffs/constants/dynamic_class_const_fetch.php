<?php
class Foo
{
    const BAR = 'bar';
}

$name = 'BAR';

// Instead of this:
constant(Foo::class . '::' . $name);

// Since PHP 8.3, you can now do this:
Foo::{$name};

