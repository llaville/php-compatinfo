<?php
openssl_sign($data, $signature, $pkeyid, OPENSSL_ALGO_SHA1);
