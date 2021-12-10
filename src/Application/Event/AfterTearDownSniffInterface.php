<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface AfterTearDownSniffInterface
{
    /**
     * Called after tear down a sniff.
     *
     * @param AfterInitializeSniffEvent<string, string> $event
     */
    public function afterTearDownSniff(AfterInitializeSniffEvent $event): void;
}
