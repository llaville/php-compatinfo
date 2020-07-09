<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Collection;

/**
 * Collection of sniffs to proceed for an analyser
 *
 * @since Class available since Release 5.4.0
 */
class SniffCollection implements \IteratorAggregate
{
    /** @var iterable */
    private $sniffs;

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
