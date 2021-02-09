<?php declare(strict_types=1);

/**
 * Collection of sniffs to proceed for an analyser
 */

namespace Bartlett\CompatInfo\Application\Collection;

use IteratorAggregate;
use Traversable;

/**
 * @since Release 5.4.0
 */
class SniffCollection implements IteratorAggregate
{
    /** @var Traversable */
    protected $sniffs;

    public function __construct(iterable $sniffs)
    {
        $this->sniffs = $sniffs;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return $this->sniffs;
    }
}
