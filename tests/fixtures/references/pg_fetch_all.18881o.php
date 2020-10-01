<?php // @link https://www.php.net/manual/en/function.pg-fetch-all.php

$conn = pg_pconnect("dbname=publisher");
if (!$conn) {
    echo "An error occurred.\n";
    exit;
}

$result = pg_query($conn, "SELECT * FROM authors");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$arr = pg_fetch_all($result, PGSQL_ASSOC );

print_r($arr);
