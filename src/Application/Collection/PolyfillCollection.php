<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Collection;

use Traversable;
use function in_array;
use function version_compare;

/**
 * @author Laurent Laville
 * @since Release 6.4.0
 */
final class PolyfillCollection implements PolyfillCollectionInterface
{
    /** @var Traversable<T> */
    private $polyfills;

    /**
     * @param iterable<T> $polyfills
     */
    public function __construct(iterable $polyfills)
    {
        $this->polyfills = $polyfills;
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
    public function getVersion(array $whitelist): string
    {
        $min = '4.0.0';
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
