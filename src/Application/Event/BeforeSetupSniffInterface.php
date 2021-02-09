<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface BeforeSetupSniffInterface
{
    /**
     * Called before initializes a sniff.
     *
     * @param BeforeInitializeSniffEvent<string, string> $event
     */
    public function beforeSetupSniff(BeforeInitializeSniffEvent $event): void;
}
