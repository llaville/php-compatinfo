<?php // @link https://www.php.net/manual/en/function.mysqli-escape-string.php

$link = mysqli_connect("localhost", "my_user", "my_password", "world");

$city = "'s Hertogenbosch";
$city = mysqli_escape_string($link, $city);
