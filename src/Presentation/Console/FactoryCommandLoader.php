<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console;

use Bartlett\CompatInfoDb\Presentation\Console\Command\BuildCommand;
use Bartlett\CompatInfoDb\Presentation\Console\Command\DiagnoseCommand;
use Bartlett\CompatInfoDb\Presentation\Console\Command\DoctorCommand;
use Bartlett\CompatInfoDb\Presentation\Console\Command\ReleaseCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader as SymfonyFactoryCommandLoader;

use Phar;
use function get_class;
use function in_array;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class FactoryCommandLoader extends SymfonyFactoryCommandLoader implements CommandLoaderInterface
{
    /**
     * FactoryCommandLoader constructor.
     *
     * @param Command[] $commands
     */
    public function __construct(iterable $commands)
    {
        $factories = [];

        $blacklist = [
            BuildCommand::class,
            DiagnoseCommand::class,
            DoctorCommand::class,
            ReleaseCommand::class,
        ];

        foreach ($commands as $command) {
            if (in_array(get_class($command), $blacklist)) {
                continue;
            }
            $factories[$command->getName()] = function () use ($command) {
                return $command;
            };
        }

        parent::__construct($factories);
    }
}
