<?php
// @link https://php.watch/versions/8.1/spread-operator-string-array-keys

$array_1 = ['foo', 'bar'];
$array_2 = ['baz', 'qux'];

function doSomething($array_1, $array_2)
{
    $array_unpacked = [...$array_1, ...$array_2, ...['quux']];
    $array_merged   = array_merge($array_1, $array_2, ['quux']);

    var_dump($array_unpacked);
    // ['foo', 'bar', 'baz', 'qux', 'quux'];

    var_dump($array_merged);
    // ['foo', 'bar', 'baz', 'qux', 'quux'];
}
