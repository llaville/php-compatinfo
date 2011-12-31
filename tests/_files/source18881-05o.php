<?php
$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'source18881-05d.php';

echo 'MD5 file hash of ' . $file . ': ' . md5_file($file, false);
