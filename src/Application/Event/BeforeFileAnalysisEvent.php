<?php declare(strict_types=1);

/**
 * The BeforeFileAnalysisEvent allows you to know what file of the data source
 * is ready to be parsed.
 */

namespace Bartlett\CompatInfo\Application\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @since Release 6.0.0
 */
final class BeforeFileAnalysisEvent extends GenericEvent
{
}
