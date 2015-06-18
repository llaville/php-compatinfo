#!/usr/bin/env php
<?php
$appName = 'phpCompatInfo';

Phar::mapPhar(strtolower($appName) . '.phar');

if (!getenv("BARTLETTRC")) {
    putenv("BARTLETTRC=" . strtolower($appName) . '.json');
}

/**
 * Ability to use global composer packages installed, then include_path,
 * for optional dependencies not provided by the phar distribution (e.g: pear/Net_Growl)
 */
$home = getenv('COMPOSER_HOME');
if (!$home) {
    if (defined('PHP_WINDOWS_VERSION_MAJOR')) {
        if (getenv('APPDATA')) {
            $home = strtr(getenv('APPDATA'), '\\', '/') . '/Composer';
        }
    } else {
        if (getenv('HOME')) {
            $home = rtrim(getenv('HOME'), '/') . '/.composer';
        }
    }
}
if ($home) {
    $fallbackNetGrowlDir = $home . '/vendor/pear-pear.php.net/Net_Growl';

    $fallbackClassMap = function ($classMap, $classPrefix) {
        array_walk(
            $classMap,
            function (&$value, $key, $userData) {
                if (strpos($key, $userData) !== false) {
                    // will remove this entry in class map
                    $value = null;
                }
            },
            $classPrefix
        );
        return $classMap;
    };
}

require 'phar://' . __FILE__ . '/bin/' . strtolower($appName);

__HALT_COMPILER();