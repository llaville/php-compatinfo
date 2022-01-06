<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console;

use Composer\InstalledVersions;

use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

use Phar;
use function basename;
use function sprintf;
use function substr;

/**
 * The CompatInfo CLI version.
 *
 * @author Laurent Laville
 * @since Release 4.0.0-alpha3+1, 6.0.0
 */
class Application extends SymfonyApplication implements ApplicationInterface
{
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

    private ContainerInterface $container;

    /**
     * Application constructor.
     *
     * @param string|null $version (optional) auto-detect
     */
    public function __construct(?string $version = null)
    {
        $version = $version ?? $this->getInstalledVersion(false);
        parent::__construct(self::NAME, $version);
    }

    /**
     * {@inheritDoc}
     * @return void
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
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
        return sprintf(
            '<info>%s</info> version <comment>%s</comment> DB version <comment>%s</comment>',
            $this->getName(),
            $this->getInstalledVersion(),
            $this->getInstalledVersion(true, 'bartlett/php-compatinfo-db')
        );
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

        $configFile = $input->getParameterOption('-c');
        if (false === $configFile) {
            $configFile = $input->getParameterOption('--config');
        }
        if (false !== $configFile) {
            $containerBuilder = new ContainerBuilder();
            try {
                $loader = new PhpFileLoader($containerBuilder, new FileLocator(dirname($configFile)));
                $loader->load(basename($configFile));
            } catch (FileLocatorFileNotFoundException $e) {
                $output = new ConsoleOutput();
                $this->renderThrowable($e, $output);
                return Command::FAILURE;
            }
            $containerBuilder->compile(); // mandatory or the sniffCollection won't be populated
            $this->setContainer($containerBuilder);
        }

        if ($input->hasParameterOption('--manifest')) {
            $phar = new Phar($_SERVER['argv'][0]);
            $manifest = $phar->getMetadata();
            $output->writeln($manifest);
            return 0;
        }

        return parent::run($input, $output);
    }

    public function getInstalledVersion(bool $withRef = true, string $packageName = 'bartlett/php-compatinfo'): string
    {
        $version = InstalledVersions::getPrettyVersion($packageName);
        if (!$withRef) {
            return $version;
        }
        $commitHash = InstalledVersions::getReference($packageName);
        return sprintf('%s@%s', $version, substr($commitHash, 0, 7));
    }
}
