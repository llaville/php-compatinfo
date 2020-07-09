<?php // @link https://www.php.net/manual/en/function.imagepng.php

$im = imagecreatefrompng("test.png");

header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);
