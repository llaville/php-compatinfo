<?php

define('__DIR__', dirname(__FILE__));

function class_alias() {}

class SplTempFileObject {}

print_r(ini_get_all("pcre", true));

$a = array('<foo>', "'bar'", '"baz"', '&blong&', "\xc3\xa9");
$json = json_encode($a, JSON_PRETTY_PRINT, 256);
