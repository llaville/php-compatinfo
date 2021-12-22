<?php declare(strict_types=1);

/**
 * Collector Handler for both Profile and Profiler.
 */

namespace Bartlett\CompatInfo\Application\Profiler;

use Bartlett\CompatInfo\Application\DataCollector\DataCollectorInterface;

use DomainException;

/**
 * @since Release 5.4.0
 */
trait CollectorTrait
{
    /** @var DataCollectorInterface[] */
    private array $collectors = [];

    /**
     * {@inheritDoc}
     */
    public function getCollectors(): array
    {
        return $this->collectors;
    }

    /**
     * {@inheritDoc}
     */
    public function getCollector(string $name): DataCollectorInterface
    {
        if (!isset($this->collectors[$name])) {
            throw new DomainException(sprintf('Collector "%s" does not exist.', $name));
        }
        return $this->collectors[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function addCollector(DataCollectorInterface $collector): void
    {
        $this->collectors[$collector->getName()] = $collector;
    }

    /**
     * {@inheritDoc}
     */
    public function setCollectors(array $collectors): void
    {
        $this->collectors = [];
        foreach ($collectors as $collector) {
            $this->addCollector($collector);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function hasCollector(string $name): bool
    {
        return isset($this->collectors[$name]);
    }
}
