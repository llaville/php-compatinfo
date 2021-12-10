<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Extension;

use LogicException;

/**
 * @since Release 6.0.0
 */
interface ExtensionLoaderInterface
{
    /**
     * @return string[]
     */
    public function getNames(): array;

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     * @return ExtensionInterface
     * @throws LogicException
     */
    public function get(string $name): ExtensionInterface;
}
