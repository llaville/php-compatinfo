<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console\Command;

use Bartlett\CompatInfo\Presentation\Console\ApplicationInterface;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function sprintf;

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
            ->setDescription('Shows short information about this package')
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        /** @var ApplicationInterface $app */
        $app = $this->getApplication();

        $defaultVersion = '7.1';

        $lines = [
            sprintf(
                '<info>%s</info> version <comment>%s</comment> DB version <comment>%s</comment>',
                $app->getName(),
                $app->getInstalledVersion(),
                $app->getInstalledVersion(true, 'bartlett/php-compatinfo-db')
            ),
            sprintf(
                '<comment>Please visit %s/%s/ for more information.</comment>',
                'https://llaville.github.io/php-compatinfo',
                $defaultVersion
            ),
        ];
        $io->text($lines);

        return self::SUCCESS;
    }
}
