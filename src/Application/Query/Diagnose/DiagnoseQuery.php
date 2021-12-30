<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Query\Diagnose;

use Bartlett\CompatInfo\Application\Query\QueryInterface;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Value Object of console diagnose command.
 *
 * @author Laurent Laville
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
