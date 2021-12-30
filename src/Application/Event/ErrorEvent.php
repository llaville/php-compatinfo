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
 * The ERROR event allows you to learn more about PHP-Parser error raised.
 *
 * The event listener method receives a Symfony\Component\EventDispatcher\GenericEvent
 * instance with following arguments :
 * - `source` data source identifier
 * - `file`   current file parsed in the data source
 * - `error`  PHP Parser error message
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class ErrorEvent extends GenericEvent
{
}
