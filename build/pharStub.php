#!/usr/bin/env php
<?php
$alias = 'phpcompatinfo.phar';
Phar::mapPhar($alias);

set_include_path(
    "phar://$alias" . PATH_SEPARATOR .
    "phar://$alias/vendor/bartlett" . PATH_SEPARATOR .
    "phar://$alias/vendor/pear"     . PATH_SEPARATOR .
    "phar://$alias/vendor/phpunit"  . PATH_SEPARATOR .
    get_include_path()
);

require_once 'PHP/Reflect/Autoload.php';
require_once 'PHP/CompatInfo/Autoload.php';
require_once 'PEAR/Exception.php';
require_once 'PHP/Timer/Autoload.php';

//define('BARTLETT_COMPOSER_INSTALL', '');

PHP_CompatInfo_CLI::main();

__HALT_COMPILER();