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
 * The AfterAnalysisEvent allows you to be notified when a data source parsing
 * is over.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `source` data source identifier
 * - `successCount` number of file successfully proceeded
 * - `profile` an instance of Bartlett\CompatInfo\Application\Profiler\Profile class results
 * - `applicationVersion` current version of application with reference (the latest commit hash)
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class AfterAnalysisEvent extends GenericEvent
{
}
