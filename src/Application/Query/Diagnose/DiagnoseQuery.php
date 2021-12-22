<?php declare(strict_types=1);

/**
 * Value Object of console diagnose command.
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link       http://bartlett.laurent-laville.org/php-compatinfo/
 */

namespace Bartlett\CompatInfo\Application\Query\Diagnose;

use Bartlett\CompatInfo\Application\Query\QueryInterface;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @since Release 6.0.0
 */
final class DiagnoseQuery implements QueryInterface
{
    private Connection $connection;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->connection = $entityManager->getConnection();
    }

    /**
     * Returns Doctrine database connection.
     *
     * @return Connection
     */
    public function getDatabaseConnection(): Connection
    {
        return $this->connection;
    }
}
