<?php
$url = 'http://username:password@hostname/path?arg=value#anchor';

echo parse_url($url, PHP_URL_PATH);
