<?php

$f = function() {
    $name = 'world';
    echo 'Hello, ' . $name;
};

call_user_func($f);
