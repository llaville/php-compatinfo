<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.1.0
 * @author Laurent Laville
 */

return function (): Generator
{
    $classes = [
        \Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityHandler::class,
        \Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery::class,
        \Bartlett\CompatInfo\Application\Query\Diagnose\DiagnoseHandler::class,
        \Bartlett\CompatInfo\Application\Query\Diagnose\DiagnoseQuery::class,
        \Bartlett\CompatInfo\Application\Query\QueryBusInterface::class,
        \Bartlett\CompatInfo\Application\Query\QueryHandlerInterface::class,
        \Bartlett\CompatInfo\Application\Query\QueryInterface::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
};
