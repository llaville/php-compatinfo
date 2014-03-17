<?php

$baseDir   = dirname(__DIR__);
$vendorDir = $baseDir . '/vendor';

require_once $vendorDir . '/nikic/php-parser/lib/bootstrap.php';
require_once $vendorDir . '/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';
require_once $vendorDir . '/phpunit/php-timer/PHP/Timer.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony\\Component\\Finder'          => $vendorDir . '/symfony/finder',
    'Symfony\\Component\\EventDispatcher' => $vendorDir . '/symfony/event-dispatcher',
    'Symfony\\Component\\Console'         => $vendorDir . '/symfony/console',
    'Symfony\\Component\\ClassLoader'     => $vendorDir . '/symfony/class-loader',
    'Bartlett\\Reflect'                   => $vendorDir . '/bartlett/php-reflect/src',
    'Bartlett\\Tests\\CompatInfo'         => $baseDir . '/tests',
    'Bartlett'                            => $baseDir . '/src',
));
$loader->register();

require __DIR__ . '/Reference/GenericTest.php';
