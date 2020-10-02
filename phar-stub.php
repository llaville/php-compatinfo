#!/usr/bin/env php
<?php
$appName = 'phpcompatinfo';

Phar::mapPhar($appName . '.phar');

require 'phar://' . __FILE__ . '/bin/' . $appName;

__HALT_COMPILER();
