<?php // @link https://www.php.net/manual/en/function.openssl-open.php

$fp = fopen("/src/openssl-0.9.6/demos/sign/key.pem", "r");
$priv_key = fread($fp, 8192);
fclose($fp);
$pkeyid = openssl_get_privatekey($priv_key);

// decrypt the data and store it in $open
if (openssl_open($sealed, $open, $env_key, $pkeyid)) {
    echo "here is the opened data: ", $open;
} else {
    echo "failed to open data";
}

// free the private key from memory
openssl_free_key($pkeyid);
