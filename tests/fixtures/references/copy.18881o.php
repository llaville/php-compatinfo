<?php
$source = 'http://www.example.com/example.txt';

/**
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);
$context = stream_context_create($opts);
*/

$dest = 'example.txt.bak';

copy($source, $dest, $context);
