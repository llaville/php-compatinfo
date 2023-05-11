<?php
// @link https://github.com/llaville/php-compatinfo/issues/359

setcookie('cookie_name', 'cookie_value', time() + 86400, '', '', false, false, 'Lax');
