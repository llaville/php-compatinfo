<?php declare(strict_types=1);

/**
 * PROGRESS event.
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link       http://bartlett.laurent-laville.org/php-compatinfo/
 */

namespace Bartlett\CompatInfo\Application\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * The PROGRESS event allows you to know what file of the data source
 * is ready to be parsed.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `source`  data source identifier
 * - `queue`   files list in the data source to parse (Symfony Finder instance)
 * - `closure` a closure to process on each file of `queue`
 *
 * @since Release 6.0.0
 */
final class ProgressEvent extends GenericEvent
{
    public function getQueue(): iterable
    {
        return $this->hasArgument('queue') ? $this->getArgument('queue') : [];
    }

    public function getClosure(): callable
    {
        return $this->hasArgument('closure') ? $this->getArgument('closure') : function () { };
    }
}
