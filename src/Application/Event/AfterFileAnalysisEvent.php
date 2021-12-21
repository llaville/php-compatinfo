<?php declare(strict_types=1);

/**
 * The AfterFileAnalysisEvent allows you to get the AST (Abstract Syntax Tree)
 * from a live request. A cached request will not trigger this event.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `file` an instance of Symfony\Component\Finder\SplFileInfo that identify current file parsed in the data source
 */

namespace Bartlett\CompatInfo\Application\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @since Release 6.0.0
 */
final class AfterFileAnalysisEvent extends GenericEvent
{

}
