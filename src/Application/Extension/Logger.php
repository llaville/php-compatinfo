<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension;

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
use Bartlett\CompatInfo\Application\Event\BeforeFileAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\BeforeFileAnalysisInterface;
use Bartlett\CompatInfo\Application\Event\BeforeInitializeSniffEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessNodeEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessNodeInterface;
use Bartlett\CompatInfo\Application\Event\BeforeProcessSniffEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessSniffInterface;
use Bartlett\CompatInfo\Application\Event\BeforeSetupSniffInterface;
use Bartlett\CompatInfo\Application\Event\ErrorEvent;

use PhpParser\NodeAbstract;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use function get_class;
use function json_encode;
use function sprintf;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class Logger implements
    ExtensionInterface,
    AfterAnalysisInterface,
    BeforeFileAnalysisInterface,
    AfterFileAnalysisInterface,
    BeforeProcessNodeInterface,
    AfterProcessNodeInterface,
    BeforeSetupSniffInterface,
    AfterTearDownSniffInterface,
    BeforeProcessSniffInterface,
    AfterProcessSniffInterface,
    EventSubscriberInterface
{
    private LoggerInterface $logger;

    /**
     * Logger extension constructor.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'logger';
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleEvents::COMMAND => 'onConsoleCommand',
            ConsoleEvents::TERMINATE => 'onConsoleTerminate',
            ErrorEvent::class => 'onError',
        ];
    }

    /**
     * Initialize logger extension, by `analyser:run --debug` command
     */
    public function onConsoleCommand(ConsoleCommandEvent $event): void
    {
        $input = $event->getInput();
        $withDebug = $input->hasOption('debug') && $input->getOption('debug');

        if (!$withDebug) {
            $this->logger = new NullLogger();
        }

        $context = ['command' => $event->getCommand()->getName()];
        $this->logger->info('Start {command} command.', $context);
    }

    public function onConsoleTerminate(ConsoleTerminateEvent $event): void
    {
        $context = ['command' => $event->getCommand()->getName()];
        $this->logger->info('Terminate {command} command.', $context);
    }

    /**
     * @inheritDoc
     */
    public function beforeAnalyzeFile(BeforeFileAnalysisEvent $event): void
    {
        $this->logger->notice('Start analysis of file "{file}"', $event->getArguments());
    }

    /**
     * @inheritDoc
     */
    public function afterAnalyzeFile(AfterFileAnalysisEvent $event): void
    {
        $this->logger->info('Analysis of file "{file}" successful.', $event->getArguments());
    }

    /**
     * @param ErrorEvent<string, string> $event
     */
    public function onError(ErrorEvent $event): void
    {
        $this->logger->error('Analysis of file "{file}" failed: {error}', $event->getArguments());
    }

    /**
     * @inheritDoc
     */
    public function afterAnalysis(AfterAnalysisEvent $event): void
    {
        $this->logger->notice(
            'Parsing the data source "{source}" is over with {successCount} files proceeded !',
            $event->getArguments()
        );
    }

    /**
     * @inheritDoc
     */
    public function beforeEnterNode(BeforeProcessNodeEvent $event): void
    {
        /** @var NodeAbstract $node */
        $node = $event->getArgument('node');
        $this->logger->debug(
            sprintf(
                'enterNode %s by %s with attributes [%s]',
                $node->getType(),
                get_class($event->getSubject()),
                json_encode($node->getAttributes())
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function afterLeaveNode(AfterProcessNodeEvent $event): void
    {
        /** @var NodeAbstract $node */
        $node = $event->getArgument('node');
        $this->logger->debug(
            sprintf(
                'leaveNode %s by %s with attributes [%s]',
                $node->getType(),
                get_class($event->getSubject()),
                json_encode($node->getAttributes())
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function beforeSetupSniff(BeforeInitializeSniffEvent $event): void
    {
        $this->logger->debug(sprintf('setUpBeforeSniff %s', get_class($event->getSubject())));
    }

    /**
     * @inheritDoc
     */
    public function afterTearDownSniff(AfterInitializeSniffEvent $event): void
    {
        $this->logger->debug(sprintf('tearDownAfterSniff %s', get_class($event->getSubject())));
    }

    /**
     * @inheritDoc
     */
    public function beforeEnterSniff(BeforeProcessSniffEvent $event): void
    {
        $this->logger->debug(sprintf('enterSniff %s', get_class($event->getSubject())));
    }

    /**
     * @inheritDoc
     */
    public function afterLeaveSniff(AfterProcessSniffEvent $event): void
    {
        $this->logger->debug(sprintf('leaveSniff %s', get_class($event->getSubject())));
    }
}
