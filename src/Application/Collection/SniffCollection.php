<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Collection;

use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;

use Traversable;

/**
 * Collection of sniffs to proceed for an analyser
 *
 * @phpstan-template T of SniffInterface
 * @phpstan-implements SniffCollectionInterface<T>
 * @author Laurent Laville
 * @since Release 5.4.0
 */
class SniffCollection implements SniffCollectionInterface
{
    /** @var Traversable<T> */
    protected Traversable $sniffs;

    /**
     * SniffCollection constructor.
     *
     * @param iterable<T> $sniffs
     */
    public function __construct(iterable $sniffs)
    {
        $this->sniffs = $sniffs;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return $this->sniffs;
    }
}
