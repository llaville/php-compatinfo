#!/usr/bin/env php
<?php
if (class_exists('Phar')) {
    Phar::mapPhar('phpcompatinfo.phar');
    Phar::interceptFileFuncs();

    if (!getenv("COMPATINFO")) {
        $home  = defined('PHP_WINDOWS_VERSION_BUILD') ? 'USERPROFILE' : 'HOME';
        $files = array(
            realpath('./phpcompatinfo.json'),
            getenv($home).'/.config/phpcompatinfo.json',
            '/etc/phpcompatinfo.json',
            'phar://' . __FILE__ . '/bin/phpcompatinfo.json.dist'
        );
        foreach ($files as $file) {
            if (file_exists($file)) {
                putenv("COMPATINFO=$file");
                break;
            }
        }
    }
    require 'phar://' . __FILE__ . '/bin/phpcompatinfo';
}
__HALT_COMPILER();