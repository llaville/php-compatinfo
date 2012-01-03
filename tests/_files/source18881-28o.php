<?php
/**
$opts = array(
    ...
);
$context = stream_context_create($opts);
*/

scandir('/tmp', 1, $context);
