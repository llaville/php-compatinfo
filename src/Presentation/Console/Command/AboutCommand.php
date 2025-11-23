<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console\Command;

use Bartlett\CompatInfo\Presentation\Console\ApplicationInterface;

use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use DateTimeImmutable;
use Locale;
use function class_exists;
use function date_default_timezone_get;
use function extension_loaded;
use function filter_var;
use function getenv;
use function ini_get;
use function php_sapi_name;
use function sprintf;
use function sscanf;
use const FILTER_VALIDATE_BOOLEAN;
use const PHP_VERSION;

/**
 * Shows short information about this package.
 *
 * @since Release 6.2.0
 * @author Laurent Laville
 */
final class AboutCommand extends AbstractCommand implements CommandInterface
{
    public const NAME = 'about';

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription('Display information about this application')
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        /** @var ApplicationInterface $app */
        $app = $this->getApplication(); // @phpstan-ignore varTag.nativeType

        $dbVersion = $app->getInstalledVersion(false, 'bartlett/php-compatinfo-db');

        list($majorVersion, $minorVersion, ) = sscanf($dbVersion, '%d.%d.%s');

        $dbWebSite = sprintf(
            '%s/%d.%d',
            'https://llaville.github.io/php-compatinfo-db',
            $majorVersion,
            $minorVersion
        );

        $parameters = $app->getApplicationParameters();

        list($majorVersion, $minorVersion, ) = sscanf($app->getLongVersion(), '%d.%d.%s');

        $webSite = sprintf(
            '%s/%d.%d',
            'https://llaville.github.io/php-compatinfo',
            $majorVersion,
            $minorVersion
        );

        $kernel = $app->getKernel();
        $xdebugMode = getenv('XDEBUG_MODE') ?: ini_get('xdebug.mode');

        $rows = [
            ['<info>CompatInfo</info></>'],
            new TableSeparator(),
            ['Name', $app->getName()],
            ['Version', $app->getLongVersion()],
            ['Web site', $webSite],
            new TableSeparator(),
            ['<info>CompatInfoDb</info></>'],
            new TableSeparator(),
            ['Name', 'Database handler for CompatInfo'],
            ['Version', $dbVersion],
            ['Web site', $dbWebSite],
            new TableSeparator(),
            ['<info>Kernel</>'],
            new TableSeparator(),
            ['Type', $kernel::class],
            ['Environment', $kernel->getEnvironment()],
            ['Debug', $kernel->isDebug() ? 'true' : 'false'],
            ['Home directory', $parameters['kernel.home_dir']],
            ['Project directory', $parameters['kernel.project_dir']],
            ['Cache directory', $parameters['kernel.cache_dir']],
            ['Build directory', $parameters['kernel.build_dir']],
            ['Log directory', $parameters['kernel.logs_dir']],
            ['Vendor directory', $parameters['kernel.vendor_dir']],
            new TableSeparator(),
            ['<info>PHP</>'],
            new TableSeparator(),
            ['Version', PHP_VERSION],
            ['SAPI', php_sapi_name()],
            ['Architecture', (\PHP_INT_SIZE * 8) . ' bits'],
            [
                'Intl locale',
                class_exists(Locale::class, false) && Locale::getDefault() ? Locale::getDefault() : 'n/a'
            ],
            [
                'Timezone',
                date_default_timezone_get() . ' (<comment>' . (new DateTimeImmutable())->format(\DateTimeInterface::W3C) . '</>)'
            ],
            [
                'OPcache',
                extension_loaded('Zend OPcache')
                    ? (filter_var(ini_get('opcache.enable'), FILTER_VALIDATE_BOOLEAN) ? 'Enabled' : 'Not enabled')
                    : 'Not installed'
            ],
            [
                'APCu',
                extension_loaded('apcu')
                    ? (filter_var(ini_get('apc.enabled'), FILTER_VALIDATE_BOOLEAN) ? 'Enabled' : 'Not enabled')
                    : 'Not installed'
            ],
            ['Xdebug',
                extension_loaded('xdebug')
                    ? ($xdebugMode && 'off' !== $xdebugMode ? 'Enabled (' . $xdebugMode . ')' : 'Not enabled')
                    : 'Not installed'
            ],
        ];

        $io->title('About Application');
        $io->table([], $rows);

        return self::SUCCESS;
    }
}
