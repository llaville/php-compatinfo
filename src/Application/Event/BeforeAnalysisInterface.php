<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Event;

/**
 * @author Laurent Laville
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
