<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface AfterAnalysisInterface
{
    /**
     * Called after analysis is completed
     *
     * @param AfterAnalysisEvent<string, string> $event
     */
    public function afterAnalysis(AfterAnalysisEvent $event): void;
}
