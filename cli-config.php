<?php

use Bartlett\CompatInfo\Infrastructure\Framework\Symfony\DependencyInjection\ContainerFactory;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

use Symfony\Component\DependencyInjection\ContainerBuilder;

require_once __DIR__ . '/config/bootstrap.php';

/** @var ContainerBuilder $container */
$container = (new ContainerFactory())->create();

$entityManager = $container->get(EntityManagerInterface::class);

return ConsoleRunner::createHelperSet($entityManager);
