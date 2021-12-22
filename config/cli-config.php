<?php declare(strict_types=1);

use Bartlett\CompatInfo\Infrastructure\Framework\Symfony\DependencyInjection\ContainerFactory;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

use Symfony\Component\DependencyInjection\ContainerBuilder;

require_once __DIR__ . '/bootstrap.php';

/** @var ContainerBuilder $container */
$container = (new ContainerFactory())->create();

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);

return ConsoleRunner::createHelperSet($entityManager);
