<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Profiler;

use Bartlett\CompatInfo\Application\DataCollector\DataCollectorInterface;

use DomainException;

/**
 * @author Laurent Laville
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
