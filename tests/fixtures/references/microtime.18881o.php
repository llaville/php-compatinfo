<?php
$time_start = microtime(true);

// Sleep for a while
//usleep(100);

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "Did nothing in $time seconds\n";
