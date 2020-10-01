<?php
function foo(...$opt) {
    var_dump($opt);
}
foo();
foo(1,2,3);
