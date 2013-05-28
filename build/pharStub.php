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

spl_autoload_register(function ($className) {
    $classFile = str_replace('_', '/', $className) . '.php';    
    $excludes  = array(
        'PHP_CompatInfo_Reference_PluginsAbstract', 
        'PHP_CompatInfo_Reference_PHP4', 
        'PHP_CompatInfo_Reference_PHP5', 
        'PHP_CompatInfo_Reference_ALL'
    );
    if (!in_array($className, $excludes)) {
        $classFile = preg_replace_callback(
            '#(.*/Reference/)(.*)$#',
            create_function(
                '$matches',
                'return ($matches[1] . strtolower($matches[2]));'
            ),
            $classFile
        );
    }
    $classPath = stream_resolve_include_path($classFile);    
    if ($classPath === FALSE) {
        return FALSE;
    }
    require $classPath;
});

define('BARTLETT_COMPOSER_INSTALL', '');

PHP_CompatInfo_CLI::main();

__HALT_COMPILER();