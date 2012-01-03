<?php
/**
$opts = array(
    ...
);
$context = stream_context_create($opts);
*/

opendir('ftp://example.com', $context);
