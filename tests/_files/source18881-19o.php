<?php
$src   = fopen('http://www.example.com', 'r');
$dest3 = fopen('after1k.txt', 'w');

echo stream_copy_to_stream($src, $dest3, 0 , 1024) . " bytes copied to after1k.txt\n";
