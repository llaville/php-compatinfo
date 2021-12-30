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
 * The BeforeFileAnalysisEvent allows you to know what file of the data source
 * is ready to be parsed.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `file` an instance of Symfony\Component\Finder\SplFileInfo that identify file to proceed
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class BeforeFileAnalysisEvent extends GenericEvent
{
}
