<?php
// @link https://wiki.php.net/rfc/spread_operator_for_array

$arr1 = [1, 2, 3];
$arr2 = [...$arr1];

var_dump($arr2); //[1, 2, 3]
