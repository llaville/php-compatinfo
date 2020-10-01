<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Event\Subscriber;

use Bartlett\Reflect\Util\Timer;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @since Class available since Release 5.4.0
 */
final class ProfileEventSubscriber implements EventSubscriberInterface
{
    /** @var Stopwatch */
    private $stopwatch;

    /**
     * ProfileEventSubscriber constructor.
     *
     * @param Stopwatch $stopwatch
     */
    public function __construct(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ConsoleEvents::COMMAND => 'onConsoleCommand',
            ConsoleEvents::TERMINATE => 'onConsoleTerminate',
        ];
    }

    /**
     * @param ConsoleCommandEvent $event
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        $this->stopwatch->reset();
        // Just before executing any command
        $this->stopwatch->start($event->getCommand()->getName());
    }

    /**
     * @param ConsoleTerminateEvent $event
     */
    public function onConsoleTerminate(ConsoleTerminateEvent $event)
    {
        // Just after executing any command
        $stopwatchEvent = $this->stopwatch->stop($event->getCommand()->getName());

        $input = $event->getInput();

        if (false === $input->hasParameterOption('--profile')) {
            return;
        }

        $output = $event->getOutput();

        $time   = $stopwatchEvent->getDuration();
        $memory = $stopwatchEvent->getMemory();

        $text = sprintf(
            '%s<comment>Time: %s, Memory: %4.2fMb</comment>',
            PHP_EOL,
            Timer::toTimeString($time),
            sprintf('%4.2fMb', $memory / (1024 * 1024))
        );
        $output->writeln($text);
    }
}
