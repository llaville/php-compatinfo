<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Query;

/**
 * @since Release 6.0.0
 */
interface QueryBusInterface
{
    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function query(QueryInterface $query);
}
