<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension;

use LogicException;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
interface ExtensionLoaderInterface
{
    /**
     * @return string[]
     */
    public function getNames(): array;

    public function has(string $name): bool;

    /**
     * @throws LogicException
     */
    public function get(string $name): ExtensionInterface;
}
