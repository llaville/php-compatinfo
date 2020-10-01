<?php

function testReturn1(): ?string
{
    return 'elePHPant';
}

var_dump(testReturn1());

function testReturn2(): ?string
{
    return null;
}

var_dump(testReturn2());

function test(?string $name)
{
    var_dump($name);
}

test('elePHPant');
test(null);
test();
