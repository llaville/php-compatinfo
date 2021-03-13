<?php

use Bartlett\CompatInfoDb\Presentation\Console\ApplicationInterface;

require_once dirname(__DIR__) . '/vendor/autoload.php';

putenv('APP_ENV=' . ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'prod'));
putenv('APP_PROXY_DIR=' . ($_SERVER['APP_PROXY_DIR'] ?? $_ENV['APP_PROXY_DIR'] ?? '/tmp/bartlett/php-compatinfo-db/' . ApplicationInterface::VERSION . '/proxies'));
