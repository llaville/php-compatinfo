<?php
// @link https://github.com/llaville/php-compatinfo-db/commit/1bbec11ebfb77146f5d78dad75af1f3ab4eb3cac
// @link https://github.com/php/php-src/blob/702d18de99875a67d694058d4b345a3606f08632/ext/openssl/tests/openssl_verify_basic.phpt


$data = "Testing openssl_verify()";
$privkey = "file://" . __DIR__ . "/private_rsa_1024.key";
$pubkey = "file://" . __DIR__ . "/public.key";

openssl_sign($data, $sign, $privkey, OPENSSL_ALGO_SHA256);
var_dump(openssl_verify($data, $sign, $pubkey, OPENSSL_ALGO_SHA256));
