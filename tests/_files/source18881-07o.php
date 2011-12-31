<?php
$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
                  "Cookie: foo=bar\r\n"
    )
);

$context = stream_context_create($opts);

$lines = file('http://www.example.com/', 0, $context);
