#!/usr/bin/env php
<?php
$appName = 'phpCompatInfo';

Phar::mapPhar(strtolower($appName) . '.phar');

if (!getenv("BARTLETTRC")) {
    putenv("BARTLETTRC=" . strtolower($appName) . '.json');
}

require 'phar://' . __FILE__ . '/bin/' . strtolower($appName);

__HALT_COMPILER();