<?php declare(strict_types=1);

/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.1.0
 * @author Laurent Laville
 */

return function (): Generator
{
    $classes = [
        \Bartlett\CompatInfo\Application\Event\Dispatcher\EventDispatcher::class,
        \Bartlett\CompatInfo\Application\Event\AfterAnalysisEvent::class,
        \Bartlett\CompatInfo\Application\Event\AfterFileAnalysisInterface::class,
        \Bartlett\CompatInfo\Application\Event\AfterFileAnalysisEvent::class,
        \Bartlett\CompatInfo\Application\Event\AfterFileAnalysisInterface::class,
        \Bartlett\CompatInfo\Application\Event\AfterInitializeSniffEvent::class,
        \Bartlett\CompatInfo\Application\Event\AfterProcessNodeEvent::class,
        \Bartlett\CompatInfo\Application\Event\AfterProcessNodeInterface::class,
        \Bartlett\CompatInfo\Application\Event\AfterProcessSniffEvent::class,
        \Bartlett\CompatInfo\Application\Event\AfterProcessSniffInterface::class,
        \Bartlett\CompatInfo\Application\Event\AfterTearDownSniffInterface::class,
        \Bartlett\CompatInfo\Application\Event\AfterTraverseAstEvent::class,
        \Bartlett\CompatInfo\Application\Event\AfterTraverseAstInterface::class,
        \Bartlett\CompatInfo\Application\Event\BeforeAnalysisEvent::class,
        \Bartlett\CompatInfo\Application\Event\BeforeAnalysisInterface::class,
        \Bartlett\CompatInfo\Application\Event\BeforeFileAnalysisEvent::class,
        \Bartlett\CompatInfo\Application\Event\BeforeFileAnalysisInterface::class,
        \Bartlett\CompatInfo\Application\Event\BeforeInitializeSniffEvent::class,
        \Bartlett\CompatInfo\Application\Event\BeforeProcessNodeEvent::class,
        \Bartlett\CompatInfo\Application\Event\BeforeProcessNodeInterface::class,
        \Bartlett\CompatInfo\Application\Event\BeforeProcessSniffEvent::class,
        \Bartlett\CompatInfo\Application\Event\BeforeProcessSniffInterface::class,
        \Bartlett\CompatInfo\Application\Event\BeforeSetupSniffInterface::class,
        \Bartlett\CompatInfo\Application\Event\BeforeTraverseAstEvent::class,
        \Bartlett\CompatInfo\Application\Event\BeforeTraverseAstInterface::class,
        \Bartlett\CompatInfo\Application\Event\ErrorEvent::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
};
