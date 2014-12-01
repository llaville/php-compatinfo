<?php

// force PHP 5.4 - doesn't work yet this way
function returnArray() {
    return ['one', 'two', 'three'];
}

$arrayValue1 = returnArray()[0];

// some extensions
ldap_bind($rs);
gd_info();
sqlite_open('hello.dat');
