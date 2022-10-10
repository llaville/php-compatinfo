<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Collection;

use ArrayIterator;
use Traversable;
use function in_array;
use function is_array;
use function iterator_count;
use function version_compare;

/**
 * @phpstan-template T of \Bartlett\CompatInfo\Application\Polyfills\PolyfillInterface
 * @phpstan-implements PolyfillCollectionInterface<T>
 * @author Laurent Laville
 * @since Release 6.4.0
 */
final class PolyfillCollection implements PolyfillCollectionInterface
{
    /** @var Traversable<T> */
    private $polyfills;

    /**
     * param iterable<T> $polyfills
     */
    public function __construct(iterable $polyfills)
    {
        $this->polyfills = is_array($polyfills) ? new ArrayIterator($polyfills) : $polyfills;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): Traversable
    {
        return $this->polyfills;
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion(array $whitelist, string $default): string
    {
        $min = iterator_count($this->polyfills) ? '4.0.0' : $default;
        foreach ($this->polyfills as $polyfill) {
            if (!in_array($polyfill->getName(), $whitelist)) {
                continue;
            }
            if (version_compare($min, $polyfill->getVersion(), 'lt')) {
                $min = $polyfill->getVersion();
            }
        }
        return $min;
    }
}
