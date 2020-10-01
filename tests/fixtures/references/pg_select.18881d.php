<?php // @link https://www.php.net/manual/en/function.pg-select.php

$db = pg_connect('dbname=foo');
// This is safe somewhat, since all values are escaped.
// However PostgreSQL supports JSON/Array. These are not
// safe by neither escape nor prepared query.
$rec = pg_select($db, 'post_log', $_POST);
if ($rec) {
    echo "Records selected\n";
    var_dump($rec);
} else {
    echo "User must have sent wrong inputs\n";
}
