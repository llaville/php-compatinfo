<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * The BeforeAnalysisEvent allows you to be notified when a data source parsing
 * is started.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `source` data source identifier
 * - `queue` an instance of Symfony\Component\Finder\Finder class, file list to proceed
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class BeforeAnalysisEvent extends GenericEvent
{
}
