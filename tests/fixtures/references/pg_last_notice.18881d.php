<?php // @link https://www.php.net/manual/en/function.pg-last-notice

$pgsql_conn = pg_connect("dbname=mark host=localhost");

$res = pg_query("CREATE TABLE test (id SERIAL)");

$notice = pg_last_notice($pgsql_conn);

echo $notice;
