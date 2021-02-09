<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Profiler;

use Bartlett\CompatInfo\Application\DataCollector\DataCollectorInterface;

use DomainException;

/**
 * @since Release 5.4.0
 */
interface CollectorInterface
{
    /**
     * Gets the Collectors associated with this profile.
     *
     * @return DataCollectorInterface[]
     */
    public function getCollectors(): array;

    /**
     * Gets a Collector by name.
     *
     * @param string $name
     * @return DataCollectorInterface
     * @throws DomainException if the Collector does not exist
     */
    public function getCollector(string $name): DataCollectorInterface;

    /**
     * Adds a Collector.
     *
     * @param DataCollectorInterface $collector
     */
    public function addCollector(DataCollectorInterface $collector): void;

    /**
     * Sets the Collectors associated with this profile.
     *
     * @param DataCollectorInterface[] $collectors
     */
    public function setCollectors(array $collectors): void;

    /**
     * Checks if a Collector identified by its name exists.
     *
     * @param string $name
     * @return bool
     */
    public function hasCollector(string $name): bool;
}
