<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface BeforeProcessSniffInterface
{
    /**
     * Called before entering a sniff.
     *
     * @param BeforeProcessSniffEvent<string, string> $event
     */
    public function beforeEnterSniff(BeforeProcessSniffEvent $event): void;
}
