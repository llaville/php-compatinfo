<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface AfterProcessSniffInterface
{
    /**
     * Called after leaving a sniff.
     *
     * @param AfterProcessSniffEvent<string, string> $event
     */
    public function afterLeaveSniff(AfterProcessSniffEvent $event): void;
}
