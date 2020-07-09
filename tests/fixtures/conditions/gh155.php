<?php

if (!function_exists('json_encode')) {
    function json_encode() {
        // ...
    }
}
do_something();

function do_something()
{
    json_encode('foo');
}
