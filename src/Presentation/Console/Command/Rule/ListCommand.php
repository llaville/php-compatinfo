<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console\Command\Rule;

use Bartlett\CompatInfo\Application\Collection\SniffCollectionInterface;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;
use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;
use Bartlett\CompatInfo\Presentation\Console\Command\AbstractCommand;
use Bartlett\CompatInfo\Presentation\Console\Command\CommandInterface;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function array_filter;
use function array_values;
use function count;
use function ksort;
use function sprintf;
use function str_replace;
use function str_starts_with;
use function strlen;
use function substr;

/**
 * @author Laurent Laville
 * @since Release 6.4.0
 */
final class ListCommand extends AbstractCommand implements CommandInterface
{
    public const NAME = 'rule:list';

    /** @var array<int, mixed> */
    private array $rules;

    private const MAX_LENGTH_DESCRIPTION = 66;

    /**
     * @param SniffCollectionInterface<SniffInterface> $sniffCollection
     */
    public function __construct(QueryBusInterface $queryBus, SniffCollectionInterface $sniffCollection)
    {
        parent::__construct($queryBus);
        /** @var array<string, array<int, mixed>> $rules */
        $rules = [];

        /** @var SniffInterface $sniff */
        foreach ($sniffCollection as $sniff) {
            foreach ($sniff->getRules() as $ruleId => $ruleValues) {
                $ruleDesc = $ruleValues['fullDescription'];
                if (strlen($ruleDesc) > self::MAX_LENGTH_DESCRIPTION) {
                    $ruleDesc = substr($ruleDesc, 0, self::MAX_LENGTH_DESCRIPTION) . ' <comment>...</comment>';
                }
                $rules[$ruleId] = [$ruleId, $ruleValues['name'], $ruleDesc];
            }
        }
        ksort($rules);
        $this->rules = array_values($rules);
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription('Display list of Compatibility Analyser rules supported')
            ->addOption(
                'php-runtime',
                null,
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'Restrict rule list to one or more PHP version (format: major.minor)'
            )
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $rows = $this->rules;
        $phpFilters = $input->getOption('php-runtime');

        if (!empty($phpFilters)) {
            $rows = array_filter($this->rules, function ($value) use ($phpFilters) {
                foreach ($phpFilters as $phpVersion) {
                    if (str_starts_with($value[0], 'CA' . str_replace('.', '', $phpVersion))) {
                        return true;
                    }
                }
                return false;
            });
        }

        $headers = ['Rule id.', 'From Sniff', 'Description'];
        $format = '%d rule%s found.';

        if (count($rows) > 0) {
            $io->table($headers, $rows);
        }

        $io->note(sprintf($format, count($rows), count($rows) > 1 ? 's' : ''));

        return self::SUCCESS;
    }
}
