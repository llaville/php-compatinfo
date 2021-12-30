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
 * The AfterFileAnalysisEvent allows you to get the AST (Abstract Syntax Tree)
 * from a live request. A cached request will not trigger this event.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `file` an instance of Symfony\Component\Finder\SplFileInfo that identify current file parsed in the data source
 * - `ast`  the Abstract Syntax Tree result (serialized)
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class AfterFileAnalysisEvent extends GenericEvent
{
}
