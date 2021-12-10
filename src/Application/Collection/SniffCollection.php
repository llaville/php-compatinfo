<?php declare(strict_types=1);

/**
 * Collection of sniffs to proceed for an analyser
 */

namespace Bartlett\CompatInfo\Application\Collection;

use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;

use Traversable;

/**
 * @phpstan-template T of \Bartlett\CompatInfo\Application\Sniffs\SniffInterface
 * @phpstan-implements SniffCollectionInterface<T>
 * @since Release 5.4.0
 */
class SniffCollection implements SniffCollectionInterface
{
    /** @var Traversable<T> */
    protected $sniffs;

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
     * {@inheritDoc}
     */
    public function getIterator(): Traversable
    {
        return $this->sniffs;
    }
}
