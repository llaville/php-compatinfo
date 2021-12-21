<?php declare(strict_types=1);

/**
 * The AfterAnalysisEvent allows you to be notified when a data source parsing
 * is over.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `source` data source identifier
 * - `successCount` number of file successfully proceeded
 * - `profile` an instance of Bartlett\CompatInfo\Application\Profiler\Profile class results
 */

namespace Bartlett\CompatInfo\Application\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @since Release 6.0.0
 */
final class AfterAnalysisEvent extends GenericEvent
{
}
