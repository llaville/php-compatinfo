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
        \Bartlett\CompatInfo\Presentation\Console\Command\AnalyserCommand::class,
        \Bartlett\CompatInfo\Presentation\Console\Command\DiagnoseCommand::class,
        \Bartlett\CompatInfo\Presentation\Console\Command\CommandInterface::class,

        \Bartlett\CompatInfo\Presentation\Console\Input\Input::class,

        \Bartlett\CompatInfo\Presentation\Console\Output\Output::class,

        \Bartlett\CompatInfo\Presentation\Console\Application::class,
        \Bartlett\CompatInfo\Presentation\Console\ApplicationInterface::class,
        \Bartlett\CompatInfo\Presentation\Console\CommandLoaderInterface::class,
        \Bartlett\CompatInfo\Presentation\Console\FactoryCommandLoader::class,
        \Bartlett\CompatInfo\Presentation\Console\Style::class,
        \Bartlett\CompatInfo\Presentation\Console\StyleInterface::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
};
