<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension;

use LogicException;
use RuntimeException;
use function array_keys;
use function get_class;
use function sprintf;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class FactoryExtensionLoader implements ExtensionLoaderInterface
{
    /** @var callable[] */
    private array $factories;

    /**
     * FactoryExtensionLoader constructor.
     *
     * @param ExtensionInterface[] $extensions
     */
    public function __construct(iterable $extensions)
    {
        $this->factories = [];

        foreach ($extensions as $extension) {
            if (!$extension instanceof ExtensionInterface) {
                throw new RuntimeException(
                    sprintf(
                        'Class "%s" does not implement a Bartlett\CompatInfo\Application\Extension\ExtensionInterface interface',
                        get_class($extension)
                    )
                );
            }
            $this->factories[$extension->getName()] = static fn(): ExtensionInterface => $extension;
        }
    }

    /**
     * @inheritDoc
     */
    public function getNames(): array
    {
        return array_keys($this->factories);
    }

    public function has(string $name): bool
    {
        return isset($this->factories[$name]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $name): ExtensionInterface
    {
        if (!isset($this->factories[$name])) {
            throw new LogicException(sprintf('Extension "%s" does not exists', $name));
        }

        $factory = $this->factories[$name];
        return $factory();
    }
}
