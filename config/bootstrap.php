<?php

$autoloader = 'vendor/autoload.php';

if (Phar::running()) {
    $phar = new Phar($argv[0]);
    $possibleAutoloadPaths = [
        'phar://' . $phar->getAlias(),
    ];
} else {
    $possibleAutoloadPaths = [
        // local dev repository
        dirname(__DIR__),
        // dependency
        dirname(__DIR__,4),
    ];
}

$isAutoloadFound = false;
foreach ($possibleAutoloadPaths as $possibleAutoloadPath) {
    if (file_exists($possibleAutoloadPath . DIRECTORY_SEPARATOR . $autoloader)) {
        require_once $possibleAutoloadPath . DIRECTORY_SEPARATOR . $autoloader;
        $isAutoloadFound = true;
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

use Bartlett\CompatInfoDb\Presentation\Console\ApplicationInterface;

putenv('APP_ENV=' . ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'prod'));
putenv('APP_PROXY_DIR=' . ($_SERVER['APP_PROXY_DIR'] ?? $_ENV['APP_PROXY_DIR'] ?? '/tmp/bartlett/php-compatinfo-db/' . ApplicationInterface::VERSION . '/proxies'));
