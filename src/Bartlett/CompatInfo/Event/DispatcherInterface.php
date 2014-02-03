<?php
/**
 * Event-driven architecture.
 * All dispatchers should implement this interface.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Event;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Holds an event dispatcher.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Interface available since Release 3.0.0RC1
 */
interface DispatcherInterface
{
    /**
     * Set the EventDispatcher of the request
     *
     * @param EventDispatcherInterface $eventDispatcher Instance of the event
     *        dispatcher
     *
     * @return self for a fuent interface
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher);

    /**
     * Get the EventDispatcher of the request
     *
     * @return Symfony\Component\EventDispatcher\EventDispatcher
     */
    public function getEventDispatcher();

    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string $eventName The name of the event to dispatch
     * @param array  $context   (optional) Contextual event data
     *
     * @return Symfony\Component\EventDispatcher\GenericEvent
     */
    public function dispatch($eventName, array $context = array());

    /**
     * Adds an event subscriber.
     *
     * @param EventSubscriberInterface $subscriber The subscriber which is
     *        interested by events
     *
     * @return self for a fuent interface
     */
    public function addSubscriber(EventSubscriberInterface $subscriber);
}
