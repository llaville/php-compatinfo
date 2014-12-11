<?php

function returnArray() {
    // array short syntax requires PHP 5.4+
    return ['one', 'two', 'three'];
}

// array dereferencing requires PHP 5.4+
$arrayValue1 = returnArray()[0];

// some extensions
ldap_bind($rs);
gd_info();
sqlite_open('hello.dat');

// this one requires PHP 5.1+
$storage = new \SplObjectStorage;
