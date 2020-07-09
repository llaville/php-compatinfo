<?php

function g1() {
    yield 2;
    yield 3;
    yield 4;
}

function g2() {
    yield 1;
    yield from g1();
    yield 5;
}

$g = g2();
foreach ($g as $yielded) {
    var_dump($yielded);
}

/*
int(1)
int(2)
int(3)
int(4)
int(5)
*/
