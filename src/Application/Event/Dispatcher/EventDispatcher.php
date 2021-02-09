<?php declare(strict_types=1);

/**
 * Event dispatcher that will inject progress display at execution.
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo_Db
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link       http://bartlett.laurent-laville.org/php-compatinfo/
 */

namespace Bartlett\CompatInfo\Application\Event\Dispatcher;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher as SymfonyEventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @since Release 6.0.0
 */
final class EventDispatcher extends SymfonyEventDispatcher
{
    public function __construct(
        EventDispatcherInterface $dispatcher,
        EventSubscriberInterface $progressEventSubscriber,
        InputInterface $input
    ) {
        parent::__construct();

        foreach ($dispatcher->getListeners() as $eventName => $listener) {
            $this->addListener($eventName, $listener);
        }

        if ($input->hasParameterOption('--progress')) {
            $this->addSubscriber($progressEventSubscriber);
        }
    }
}
