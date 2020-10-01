<?php // @link https://www.php.net/manual/en/function.imagepng.php

$im = imagecreatefrompng("test.png");

header('Content-Type: image/png');

$file = 'image.png';

imagepng($im, $file);
imagedestroy($im);
