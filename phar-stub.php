#!/usr/bin/env php
<?php
if (class_exists('Phar')) {
    Phar::mapPhar('phpreflect.phar');
    Phar::interceptFileFuncs();

    if (!getenv("REFLECT")) {
        $files = array(
            realpath('./reflect.json'),
            getenv('HOME').'/.config/phpreflect.json',
            '/etc/phpreflect.json',
        );
        foreach ($files as $file) {
            if (file_exists($file)) {
                putenv("REFLECT=$file");
                break;
            }
        }
    }
    require 'phar://' . __FILE__ . '/bin/reflect';
}
__HALT_COMPILER();