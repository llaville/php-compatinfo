<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface AfterFileAnalysisInterface
{
    /**
     * Called after a file has been analysed
     *
     * @param AfterFileAnalysisEvent<string, string> $event
     */
    public function afterAnalyzeFile(AfterFileAnalysisEvent $event): void;
}
