<?php
$db = sqlite_open('mysqlitedb');
sqlite_query($db, 'CREATE TABLE foo (bar varchar(10), arf text)');
$cols = sqlite_fetch_column_types('foo', $db);
