<?php // @link https://www.php.net/manual/en/function.openssl-decrypt.php

$data = 'string-to-crypt';

$key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
$iv = hex2bin('34857d973953e44afb49ea9d61104d8c');

$output = openssl_decrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
