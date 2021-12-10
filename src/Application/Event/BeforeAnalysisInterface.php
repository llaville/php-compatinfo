<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface BeforeAnalysisInterface
{
    /**
     * Called before analysis begins to run
     *
     * @param BeforeAnalysisEvent<string, string> $event
     */
    public function beforeAnalysis(BeforeAnalysisEvent $event): void;
}
