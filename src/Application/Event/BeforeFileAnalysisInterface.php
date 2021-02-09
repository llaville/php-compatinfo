<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface BeforeFileAnalysisInterface
{
    /**
     * Called before a file has been analysed
     *
     * @param BeforeFileAnalysisEvent<string, string> $event
     */
    public function beforeAnalyzeFile(BeforeFileAnalysisEvent $event): void;
}
