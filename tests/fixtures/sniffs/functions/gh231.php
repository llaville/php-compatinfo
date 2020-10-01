<?php

$f = function() {
    $name = 'world';
    echo 'Hello, ' . $name . PHP_EOL;
};

call_user_func($f);  // output: Hello, world
