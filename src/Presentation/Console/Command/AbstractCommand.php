<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Presentation\Console\Command;

use Bartlett\CompatInfo\Application\Query\QueryBusInterface;

use Symfony\Component\Console\Command\Command;

/**
 * @since Release 6.0.0
 */
abstract class AbstractCommand extends Command
{
    public const SUCCESS = 0;
    public const FAILURE = 1;

    /** @var QueryBusInterface */
    protected $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        parent::__construct();
        $this->queryBus = $queryBus;
    }
}
