<?php
// @link https://github.com/llaville/php-compatinfo/issues/359

setcookie('cookie_name', 'cookie_value', [
  'samesite' => 'Lax', // Allowed values: "Lax" or "Strict"
  'expires' => time() + 86400,
]);
