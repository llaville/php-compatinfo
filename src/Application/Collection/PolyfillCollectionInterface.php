<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Collection;

use IteratorAggregate;

/**
 * @phpstan-template T of \Bartlett\CompatInfo\Application\Polyfills\PolyfillInterface
 * @phpstan-extends  IteratorAggregate<T>
 * @author Laurent Laville
 * @since Release 6.4.0
 */
interface PolyfillCollectionInterface extends IteratorAggregate
{
    /**
     * @param string[] $whitelist
     */
    public function getVersion(array $whitelist, string $default): string;
}
