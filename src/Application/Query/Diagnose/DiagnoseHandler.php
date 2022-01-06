<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Query\Diagnose;

use Bartlett\CompatInfo\Application\Query\QueryHandlerInterface;
use Bartlett\CompatInfoDb\Application\Query\Diagnose\DiagnoseHandler as CompatInfoDbDiagnoseHandler;
use Bartlett\CompatInfoDb\Application\Query\Diagnose\DiagnoseQuery as CompatInfoDbDiagnoseQuery;
use Bartlett\CompatInfoDb\Infrastructure\RequirementsInterface;

/**
 * Handler to diagnose common errors in current platform.
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class DiagnoseHandler implements QueryHandlerInterface
{
    private CompatInfoDbDiagnoseHandler $innerHandler;

    public function __construct(CompatInfoDbDiagnoseHandler $handler)
    {
        $this->innerHandler = $handler;
    }

    public function __invoke(DiagnoseQuery $query): RequirementsInterface
    {
        $handler = $this->innerHandler;
        return $handler(new CompatInfoDbDiagnoseQuery($query->getDatabaseConnection()));
    }
}
