<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Kernel;

use Bartlett\CompatInfo\Application\Configuration\ConfigResolver;
use Bartlett\CompatInfo\Presentation\Console\ApplicationInterface;
use Bartlett\CompatInfo\Presentation\Console\Command\AbstractCommand;
use Bartlett\CompatInfo\Presentation\Console\Style;
use Bartlett\CompatInfoDb\Application\Kernel\AbstractKernel;
use Bartlett\CompatInfoDb\Application\Kernel\ConsoleKernelInterface;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Throwable;
use function array_merge;
use function array_search;
use function implode;
use function str_replace;
use const DIRECTORY_SEPARATOR;

/**
 * @author Laurent Laville
 * @since Release 6.5.0
 */
final class ConsoleKernel extends AbstractKernel implements ConsoleKernelInterface
{
    /**
     * @inheritDoc
     */
    public function getCacheDir(): string
    {
        return implode(DIRECTORY_SEPARATOR, [$this->getHomeDir(), '.cache', 'bartlett']);
    }

    /**
     * @inheritDoc
     */
    public function handle(InputInterface $input = null): int
    {
        if (null === $input) {
            $input = new ArgvInput();
        }
        $container = $this->createFromInput($input);

        try {
            $app = $container->get(ApplicationInterface::class);
            return $app->run();
        } catch (Throwable $e) {
            $output = new ConsoleOutput();
            $io = new Style($input, $output);
            $io->error($e->getMessage());
            return AbstractCommand::FAILURE;
        }
    }

    /**
     * @inheritDoc
     */
    public function createFromInput(InputInterface $input = null): ContainerInterface
    {
        if (null === $input) {
            $input = new ArgvInput();
        }
        $configResolver = new ConfigResolver($input);

        $configFiles = array_merge(
            [
                $this->getConfigDir() . '/packages/messenger.php',
                $this->getConfigDir() . '/packages/console.php',
            ],
            $configResolver->provide(),
        );

        return $this->createFromConfigs($configFiles);
    }

    /**
     * @inheritDoc
     */
    protected function getContainerClass(): string
    {
        if (!array_search('without-polyfill.php', $this->configFiles)) {
            $class = parent::getContainerClass();
        } else {
            $class = str_replace('Container', 'PolyfillContainer', parent::getContainerClass());
        }
        if (array_search('default-logger.php', $this->configFiles)) {
            $class = str_replace('Container', 'LoggerContainer', $class);
        }
        return $class;
    }
}
