<?php
$foo = ['bar' => 'bar'];

var_dump("$foo[bar]");
var_dump("{$foo['bar']}");
var_dump("${foo['bar']}"); // deprecated since PHP 8.2.0
