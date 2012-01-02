<?php
$url = 'http://username:password@hostname/path?arg=value#anchor';

print_r(parse_url($url));
