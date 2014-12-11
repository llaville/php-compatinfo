<?php

// some extensions
ldap_bind($rs);
gd_info();
sqlite_open('hello.dat');

// this one requires PHP 5.1+
$storage = new \SplObjectStorage;
