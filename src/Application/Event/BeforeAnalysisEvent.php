<?php declare(strict_types=1);

/**
 * The BeforeAnalysisEvent allows you to be notified when a data source parsing
 * is started.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `source` data source identifier
 * - `queue` an instance of Symfony\Component\Finder\Finder class, file list to proceed
 */

namespace Bartlett\CompatInfo\Application\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @since Release 6.0.0
 */
final class BeforeAnalysisEvent extends GenericEvent
{

}
