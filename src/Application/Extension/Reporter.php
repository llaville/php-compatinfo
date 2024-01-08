<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension;

use Bartlett\CompatInfo\Application\Event\AfterAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\AfterAnalysisInterface;
use Bartlett\CompatInfo\Application\Profiler\Profile;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function in_array;

/**
 * @author Laurent Laville
 * @since Release 6.1.0
 */
abstract class Reporter implements ExtensionInterface, AfterAnalysisInterface
{
    protected const NAME = 'custom';
    protected InputInterface $input;
    protected OutputInterface $output;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return static::NAME . '_reporter';
    }

    /**
     * @param string[] $formats
     */
    public function supportsFormatting(object $object, array $formats): bool
    {
        return ($object instanceof Profile && in_array(static::NAME, $formats));
    }

    /**
     * @inheritDoc
     */
    public function afterAnalysis(AfterAnalysisEvent $event): void
    {
        if ($event->hasArgument('profile') && $this->input->hasOption('output')) {
            $this->format($event->getArgument('profile'));  // @phpstan-ignore-line
        }
    }
}
