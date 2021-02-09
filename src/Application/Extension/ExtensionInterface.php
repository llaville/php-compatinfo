<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Extension;

/**
 * @since Release 6.0.0
 */
interface ExtensionInterface
{
    /**
     * Returns name of extension (must be unique)
     *
     * @return string
     */
    public function getName(): string;
}
