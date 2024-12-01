<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Laurent Laville
 */

use Bartlett\CompatInfo\Application\Kernel\ConsoleKernel;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once __DIR__ . '/../autoload.php';

$container = (new ConsoleKernel('dev', false))->createFromConfigs([]);

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);

// @link https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/tools.html#doctrine-console
return new SingleManagerProvider($entityManager);
