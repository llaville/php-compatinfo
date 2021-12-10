<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface AfterProcessNodeInterface
{
    /**
     * Called after leaving a node.
     *
     * @param AfterProcessNodeEvent<string, string> $event
     */
    public function afterLeaveNode(AfterProcessNodeEvent $event): void;
}
