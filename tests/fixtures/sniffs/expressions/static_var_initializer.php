<?php
function bar() {
    return 1;
}

function foo() {
    static $i = bar();
    echo $i++, "\n";
}
