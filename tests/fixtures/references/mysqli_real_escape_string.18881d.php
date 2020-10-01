<?php // @link https://www.php.net/manual/en/mysqli.real-escape-string.php

$link = mysqli_connect("localhost", "my_user", "my_password", "world");

$city = "'s Hertogenbosch";
$city = mysqli_real_escape_string($link, $city);
