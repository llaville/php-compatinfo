<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Api\V5;

use SplPriorityQueue;
use function is_int;
use const PHP_INT_MAX;

/**
 * PriorityQueue implementation that avoid duplicated entries.
 *
 * @link https://mwop.net/blog/253-Taming-SplPriorityQueue.html
 * @since Class available since Release 5.4.0
 */
class PriorityQueue extends SplPriorityQueue
{
    private $queueOrder = PHP_INT_MAX;
    private $uniqueValues = [];

    /**
     * {@inheritDoc}
     */
    final public function insert($value, $priority)
    {
        if (is_int($priority)) {
            $priority = [$priority, $this->queueOrder--];
        }

        if (!isset($this->uniqueValues[$value->getPathname()])) {
            $this->uniqueValues[$value->getPathname()] = true;
            parent::insert($value, $priority);
        }
    }
}
