<?php declare(strict_types=1);

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

$containerBuilder = new ContainerBuilder();
$loader = new PhpFileLoader($containerBuilder, new FileLocator(__DIR__ . '/set'));
$loader->load('default.php');

$containerBuilder->compile(); // mandatory or the sniffCollection won't be populated
return $containerBuilder;
