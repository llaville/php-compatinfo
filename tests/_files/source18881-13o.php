<?php
// Read 14 characters starting from the 21st character
$section = file_get_contents('./people.txt', NULL, NULL, 20, 14);
