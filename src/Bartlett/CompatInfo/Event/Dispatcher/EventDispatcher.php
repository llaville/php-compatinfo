<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Event\Dispatcher;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher as SymfonyEventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @since Class available since Release 5.4.0
 */
final class EventDispatcher extends SymfonyEventDispatcher
{
    public function __construct(
        InputInterface $input,
        EventSubscriberInterface $profileEventSubscriber,
        EventSubscriberInterface $logEventSubscriber
    ) {
        parent::__construct();

        if ($input->hasParameterOption('--profile')) {
            $this->addSubscriber($profileEventSubscriber);
        }
        if ($input->hasParameterOption('--debug')) {
            $this->addSubscriber($logEventSubscriber);
        }
    }
}
