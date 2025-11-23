<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console;

use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Console Application contract.
 *
 * @since Release 6.0.0
 * @author Laurent Laville
 */
interface ApplicationInterface
{
    public const NAME = 'phpCompatInfo';

    public function setContainer(?ContainerInterface $container = null): void;

    /**
     * @return void
     */
    public function setCommandLoader(CommandLoaderInterface $commandLoader);

    /**
     * Gets the name of the application.
     */
    public function getName(): string;

    /**
     * Returns the long version of the application.
     */
    public function getLongVersion(): string;

    public function getInstalledVersion(bool $withRef = true, string $packageName = 'bartlett/php-compatinfo'): ?string;

    /**
     * @return array<string, mixed>
     */
    public function getApplicationParameters(): array;

    /**
     * Gets the current light kernel used by this application.
     */
    public function getKernel(): object;
}
