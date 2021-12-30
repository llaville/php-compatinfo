<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console\Command;

use Bartlett\CompatInfo\Application\Query\QueryBusInterface;

use Symfony\Component\Console\Command\Command;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
abstract class AbstractCommand extends Command
{
    public const SUCCESS = 0;
    public const FAILURE = 1;

    protected QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        parent::__construct();
        $this->queryBus = $queryBus;
    }
}
