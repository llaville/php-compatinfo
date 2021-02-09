<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface BeforeProcessNodeInterface
{
    /**
     * Called before entering a node.
     *
     * @param BeforeProcessNodeEvent<string, string> $event
     */
    public function beforeEnterNode(BeforeProcessNodeEvent $event): void;
}
