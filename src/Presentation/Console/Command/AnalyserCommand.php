<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console\Command;

use Bartlett\CompatInfo\Application\Extension\Composer\MinimalAnalyserResult;
use Bartlett\CompatInfo\Application\Extension\Composer\Parser;
use Bartlett\CompatInfo\Application\Extension\Composer\Verifier;
use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Presentation\Console\ApplicationInterface;
use Bartlett\CompatInfo\Presentation\Console\Style;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

use function sprintf;

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
                'verify-composer-json',
                null,
                null,
                'verifies a composer.json file; expected in the working path'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
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
            /** @var Profile $profile */
            $profile = $this->queryBus->query($compatibilityQuery);
        } catch (HandlerFailedException $e) {
            $exceptions = [];
            foreach ($e->getNestedExceptions() as $exception) {
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

        if ($input->getOption('verify-composer-json')) {
            $io = new Style($input, $output);
            $io->info('starting composer.json verification');

            // @TODO: not sure if we need to provide a path besides the current working directory
            //        for a composer.json to check against?

            $composerPath = 'composer.json';

            $composerJsonParser = new Parser($composerPath);

            $minimalAnalyserResult = MinimalAnalyserResult::fromProfileFactory($profile->getData());

            $verifier = new Verifier($minimalAnalyserResult, $composerJsonParser);
            $verificationResult = $verifier->verify();

            foreach ($verifier->getMessages() as $message) {
                switch ($message['type']) {
                    case Verifier::MESSAGE_TYPE_INFO:
                        $io->info($message['message']);
                        break;
                    case Verifier::MESSAGE_TYPE_WARNING:
                        $io->warning($message['message']);
                        break;
                    case Verifier::MESSAGE_TYPE_ERROR:
                        $io->error($message['message']);
                        break;
                }
            }

            if (!$verificationResult)
            {
                $io->error('composer.json verification failed!');
                return self::FAILURE;
            }

            $io->success('composer.json verification successful!');
        }

        return self::SUCCESS;
    }
}
