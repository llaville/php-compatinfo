<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Laurent Laville
 */

if (isset($_composer_autoload_path)) {
    $possibleAutoloadPaths = [
        dirname($_composer_autoload_path)
    ];
    $autoloader = basename($_composer_autoload_path);
} else {
    $possibleAutoloadPaths = [
        // local dev repository
        dirname(__DIR__),
        // dependency
        dirname(__DIR__, 4),
    ];
    $autoloader = 'vendor/autoload.php';
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
    fwrite(
        STDERR,
        'You need to set up the project dependencies using Composer:' . PHP_EOL . PHP_EOL .
        '    composer install' . PHP_EOL . PHP_EOL .
        'You can learn all about Composer on https://getcomposer.org/.' . PHP_EOL
    );
    exit(1);
}
