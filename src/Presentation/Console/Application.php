<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console;

use Bartlett\CompatInfo\Presentation\Console\Command\AbstractCommand;
use Bartlett\CompatInfoDb\Infrastructure\Framework\Composer\InstalledVersions;

use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Phar;
use function sprintf;

/**
 * The CompatInfo CLI version.
 *
 * @author Laurent Laville
 * @since Release 4.0.0-alpha3+1, 6.0.0
 */
class Application extends SymfonyApplication implements ApplicationInterface
{
    use ContainerAwareTrait;

    /**
     * @var string
     * @link http://patorjk.com/software/taag/#p=display&f=Standard&t=phpCompatInfo
     * editorconfig-checker-disable
     */
    protected static string $logo = "        _            ____                            _   ___        __
  _ __ | |__  _ __  / ___|___  _ __ ___  _ __   __ _| |_|_ _|_ __  / _| ___
 | '_ \| '_ \| '_ \| |   / _ \| '_ ` _ \| '_ \ / _` | __|| || '_ \| |_ / _ \
 | |_) | | | | |_) | |__| (_) | | | | | | |_) | (_| | |_ | || | | |  _| (_) |
 | .__/|_| |_| .__/ \____\___/|_| |_| |_| .__/ \__,_|\__|___|_| |_|_|  \___/
 |_|         |_|                        |_|

";
    // editorconfig-checker-enable

    /**
     * Application constructor.
     */
    public function __construct(EventDispatcherInterface $compatibilityEventDispatcher)
    {
        parent::__construct(
            self::NAME,
            $this->getInstalledVersion(false)
        );
        $this->setDispatcher($compatibilityEventDispatcher);
    }

    /**
     * {@inheritDoc}
     */
    public function getHelp(): string
    {
        return sprintf(
            '<comment>%s</comment><info>%s</info> version <comment>%s</comment> DB version <comment>%s</comment>',
            static::$logo,
            $this->getName(),
            $this->getVersion(),
            $this->getInstalledVersion(false, 'bartlett/php-compatinfo-db')
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getLongVersion(): string
    {
        return $this->getInstalledVersion();
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultInputDefinition(): InputDefinition
    {
        $definition = parent::getDefaultInputDefinition();
        $definition->addOption(
            new InputOption(
                'profile',
                null,
                InputOption::VALUE_NONE,
                'Display timing and memory usage information'
            )
        );
        $definition->addOption(
            new InputOption(
                'progress',
                null,
                InputOption::VALUE_NONE,
                'Show progress bar'
            )
        );
        $definition->addOption(
            new InputOption(
                'output',
                null,
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'Affect output to produce results in different format',
                ['console']
            )
        );
        $definition->addOption(
            new InputOption(
                'debug',
                null,
                InputOption::VALUE_NONE,
                'Display debugging information'
            )
        );
        if (Phar::running()) {
            $definition->addOption(
                new InputOption(
                    'manifest',
                    null,
                    InputOption::VALUE_NONE,
                    'Show which versions of dependencies are bundled'
                )
            );
        } else {
            $definition->addOption(
                new InputOption(
                    'config',
                    'c',
                    InputOption::VALUE_REQUIRED,
                    'Read configuration from PHP file'
                )
            );
        }
        $definition->addOption(
            new InputOption(
                'php',
                null,
                InputOption::VALUE_REQUIRED,
                'PHP feature version (format Major.Minor)'
            )
        );
        return $definition;
    }

    /**
     * {@inheritDoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null): int
    {
        if (null === $input) {
            if ($this->container->has(InputInterface::class)) {
                $input = $this->container->get(InputInterface::class);
            } else {
                $input = new ArgvInput();
            }
        }

        if (null === $output) {
            if ($this->container->has(OutputInterface::class)) {
                $output = $this->container->get(OutputInterface::class);
            } else {
                $output = new ConsoleOutput();
            }
        }

        return parent::run($input, $output);
    }

    public function getInstalledVersion(bool $withRef = true, string $packageName = 'bartlett/php-compatinfo'): ?string
    {
        return InstalledVersions::getPrettyVersion($packageName, $withRef);
    }

    /**
     * {@inheritDoc}
     */
    public function getApplicationParameters(): array
    {
        /** @var Container $container */
        $container = $this->container;
        return $container->getParameterBag()->all();
    }

    /**
     * {@inheritDoc}
     */
    public function getKernel(): object
    {
        return $this->container->get('kernel');
    }
}
