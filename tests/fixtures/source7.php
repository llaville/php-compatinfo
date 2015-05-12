<?php
// PHP-5.4 feature: Array Dereferencing
// @link https://wiki.php.net/rfc/functionarraydereferencing RFC

function fruit () {
  return array('a' => 'apple', 'b' => 'banana');
}

echo fruit()['a']; // apple
