<?php declare(strict_types=1);

require_once 'config/bootstrap.php';

use Bartlett\CompatInfo\Infrastructure\Framework\Composer\InstalledPackages;

// $cacheDir is defined in config/bootstrap.php
if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

// without polyfills, to avoid in first attempt to fail existing unit tests
//InstalledPackages::getInstalledPolyfills();
file_put_contents($cacheDir . DIRECTORY_SEPARATOR . 'php-compatinfo-polyfills.lock', "{}");
