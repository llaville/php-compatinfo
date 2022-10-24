<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Event\Dispatcher;

use Bartlett\CompatInfo\Application\Event\AfterAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\AfterAnalysisInterface;
use Bartlett\CompatInfo\Application\Event\AfterFileAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\AfterFileAnalysisInterface;
use Bartlett\CompatInfo\Application\Event\AfterInitializeSniffEvent;
use Bartlett\CompatInfo\Application\Event\AfterProcessNodeEvent;
use Bartlett\CompatInfo\Application\Event\AfterProcessNodeInterface;
use Bartlett\CompatInfo\Application\Event\AfterProcessSniffEvent;
use Bartlett\CompatInfo\Application\Event\AfterProcessSniffInterface;
use Bartlett\CompatInfo\Application\Event\AfterTearDownSniffInterface;
use Bartlett\CompatInfo\Application\Event\AfterTraverseAstEvent;
use Bartlett\CompatInfo\Application\Event\AfterTraverseAstInterface;
use Bartlett\CompatInfo\Application\Event\BeforeAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\BeforeAnalysisInterface;
use Bartlett\CompatInfo\Application\Event\BeforeFileAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\BeforeFileAnalysisInterface;
use Bartlett\CompatInfo\Application\Event\BeforeInitializeSniffEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessNodeEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessNodeInterface;
use Bartlett\CompatInfo\Application\Event\BeforeProcessSniffEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessSniffInterface;
use Bartlett\CompatInfo\Application\Event\BeforeSetupSniffInterface;
use Bartlett\CompatInfo\Application\Event\BeforeTraverseAstEvent;
use Bartlett\CompatInfo\Application\Event\BeforeTraverseAstInterface;
use Bartlett\CompatInfo\Application\Extension\ExtensionLoaderInterface;
use Bartlett\CompatInfo\Presentation\Console\Command\AbstractCommand;
use Bartlett\CompatInfo\Presentation\Console\Style;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\EventDispatcher\EventDispatcher as SymfonyEventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use function str_starts_with;

/**
 * Event dispatcher.
 *
 * @author Laurent Laville
 * @since Release 5.4.0, 6.0.0
 */
final class EventDispatcher extends SymfonyEventDispatcher
{
    private ExtensionLoaderInterface $extensionLoader;
    private BufferedOutput $diagnoseOutput;

    public function __construct(
        InputInterface $input,
        EventSubscriberInterface $profileEventSubscriber,
        ExtensionLoaderInterface $extensionLoader
    ) {
        parent::__construct();

        if ($input->hasParameterOption('--profile')) {
            $this->addSubscriber($profileEventSubscriber);
        }

        $this->addListener(ConsoleEvents::COMMAND, function (ConsoleCommandEvent $event) {
            $command = $event->getCommand();
            if (
                (str_starts_with($command->getName(), 'db:') && !in_array($command->getName(), ['db:create', 'db:init']))
                || str_starts_with($command->getName(), 'analyser:')
            ) {
                $app = $command->getApplication();
                // launch auto diagnose
                $diagnoseCommand = $app->find('diagnose');
                // and print results
                $this->diagnoseOutput = new BufferedOutput();
                $this->diagnoseOutput->setDecorated(true);
                $statusCode = $diagnoseCommand->run(new ArrayInput([]), $this->diagnoseOutput);
                if ($statusCode === AbstractCommand::FAILURE) {
                    $event->disableCommand();
                }
            }
        }, 100); // with a priority highest to default (in case of --profile usage)

        $this->addListener(ConsoleEvents::TERMINATE, function (ConsoleTerminateEvent $event) {
            $command = $event->getCommand();
            if ($event->getExitCode() == ConsoleCommandEvent::RETURN_CODE_DISABLED) {
                $io = new Style($event->getInput(), $event->getOutput());
                $io->writeln($this->diagnoseOutput->fetch());
            }
        }, 100); // with a priority highest to default (in case of --profile usage)

        foreach ($extensionLoader->getNames() as $extensionName) {
            $extension = $extensionLoader->get($extensionName);
            if ($extension instanceof EventSubscriberInterface) {
                $this->addSubscriber($extension);
            }
        }

        $this->extensionLoader = $extensionLoader;
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch($event, string $eventName = null): object
    {
        $triggered = false;
        foreach ($this->extensionLoader->getNames() as $extensionName) {
            $extension = $this->extensionLoader->get($extensionName);

            if ($extension instanceof BeforeAnalysisInterface && $event instanceof BeforeAnalysisEvent) {
                $extension->beforeAnalysis($event);
                $triggered = true;
            } elseif ($extension instanceof AfterAnalysisInterface && $event instanceof AfterAnalysisEvent) {
                $extension->afterAnalysis($event);
                $triggered = true;
            } elseif ($extension instanceof BeforeFileAnalysisInterface && $event instanceof BeforeFileAnalysisEvent) {
                $extension->beforeAnalyzeFile($event);
                $triggered = true;
            } elseif ($extension instanceof AfterFileAnalysisInterface && $event instanceof AfterFileAnalysisEvent) {
                $extension->afterAnalyzeFile($event);
                $triggered = true;
            } elseif ($extension instanceof BeforeTraverseAstInterface && $event instanceof BeforeTraverseAstEvent) {
                $extension->beforeTraverseAst($event);
                $triggered = true;
            } elseif ($extension instanceof AfterTraverseAstInterface && $event instanceof AfterTraverseAstEvent) {
                $extension->afterTraverseAst($event);
                $triggered = true;
            } elseif ($extension instanceof BeforeProcessNodeInterface && $event instanceof BeforeProcessNodeEvent) {
                $extension->beforeEnterNode($event);
                $triggered = true;
            } elseif ($extension instanceof AfterProcessNodeInterface && $event instanceof AfterProcessNodeEvent) {
                $extension->afterLeaveNode($event);
                $triggered = true;
            } elseif ($extension instanceof BeforeSetupSniffInterface && $event instanceof BeforeInitializeSniffEvent) {
                $extension->beforeSetupSniff($event);
                $triggered = true;
            } elseif ($extension instanceof AfterTearDownSniffInterface && $event instanceof AfterInitializeSniffEvent) {
                $extension->afterTearDownSniff($event);
                $triggered = true;
            } elseif ($extension instanceof BeforeProcessSniffInterface && $event instanceof BeforeProcessSniffEvent) {
                $extension->beforeEnterSniff($event);
                $triggered = true;
            } elseif ($extension instanceof AfterProcessSniffInterface && $event instanceof AfterProcessSniffEvent) {
                $extension->afterLeaveSniff($event);
                $triggered = true;
            }
        }

        if ($triggered) {
            return $event;
        }
        return parent::dispatch($event, $eventName);
    }
}
