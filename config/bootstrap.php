<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Laurent Laville
 */

$autoloader = 'vendor/autoload.php';

if (Phar::running()) {
    $phar = new Phar($_SERVER['argv'][0]);
    $possibleAutoloadPaths = [
        'phar://' . $phar->getAlias(),
    ];
} else {
    $possibleAutoloadPaths = [
        // local dev repository
        dirname(__DIR__),
        // dependency
        dirname(__DIR__, 4),
    ];
}

$isAutoloadFound = false;
foreach ($possibleAutoloadPaths as $possibleAutoloadPath) {
    if (file_exists($possibleAutoloadPath . DIRECTORY_SEPARATOR . $autoloader)) {
        require_once $possibleAutoloadPath . DIRECTORY_SEPARATOR . $autoloader;
        $isAutoloadFound = true;
        $vendorDir = $possibleAutoloadPath . DIRECTORY_SEPARATOR . dirname($autoloader);
        break;
    }
}

if ($isAutoloadFound === false) {
    throw new RuntimeException(
        sprintf(
            'Unable to find "%s" in "%s" paths.',
            $autoloader,
            implode('", "', $possibleAutoloadPaths)
        )
    );
}

use Composer\InstalledVersions;

$version = InstalledVersions::getPrettyVersion('bartlett/php-compatinfo-db');

putenv('APP_ENV=' . ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'prod'));
putenv('APP_PROXY_DIR=' . ($_SERVER['APP_PROXY_DIR'] ?? $_ENV['APP_PROXY_DIR'] ?? '/tmp/bartlett/php-compatinfo-db/' . $version . '/proxies'));
putenv('APP_VENDOR_DIR=' . ($_SERVER['APP_VENDOR_DIR'] ?? $_ENV['APP_VENDOR_DIR'] ?? $vendorDir));
