<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console\Command;

use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Presentation\Console\ApplicationInterface;
use Bartlett\CompatInfo\Presentation\Console\Style;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

use function sprintf;
use function version_compare;
use const PHP_VERSION;

/**
 * Analyse a data source to find out requirements.
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class AnalyserCommand extends AbstractCommand implements CommandInterface
{
    public const NAME = 'analyser:run';

    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription('Analyse a data source to find out requirements')
            ->addArgument(
                'source',
                InputArgument::REQUIRED,
                'Path to the data source'
            )
            ->addOption(
                'exclude',
                'e',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'Provide one or more folders to exclude from data source scan'
            )
            ->addOption(
                'stop-on-failure',
                null,
                null,
                'Stop execution upon first error generated during lexing, parsing or some other operation'
            )
            ->addOption(
                'no-polyfills',
                null,
                null,
                'Whether to disable polyfills'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var ApplicationInterface $app */
        $app = $this->getApplication();
        $compatibilityQuery = new GetCompatibilityQuery(
            $input->getArgument('source'),
            $input->getOption('exclude'),
            $input->getOption('stop-on-failure'),
            $app->getInstalledVersion()
        );

        try {
            $this->queryBus->query($compatibilityQuery);
        } catch (HandlerFailedException $e) {
            $exceptions = [];
            if (version_compare(PHP_VERSION, '8.1', 'ge')) {
                $failures = $e->getWrappedExceptions();
            } else {
                // still keep compatibility with Symfony Messenger Component 6.0
                $failures = $e->getNestedExceptions();
            }
            foreach ($failures as $exception) {
                $exceptions[] = $exception->getMessage()
                    . sprintf(' from file "%s" at line %d', $exception->getFile(), $exception->getLine());
            }
            $io = new Style($input, $output);
            $io->error(
                sprintf(
                    'Cannot analyse data source "%s" for following reason(s)',
                    $compatibilityQuery->getSource()
                )
            );
            $io->listing($exceptions);
            /** @var ApplicationInterface $app */
            $app = $this->getApplication();
            $io->note(
                sprintf(
                    'Issue found by %s version %s with DB version %s',
                    $app->getName(),
                    $app->getInstalledVersion(),
                    $app->getInstalledVersion(true, 'bartlett/php-compatinfo-db')
                )
            );
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
