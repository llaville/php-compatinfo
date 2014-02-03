<?php

namespace Bartlett\CompatInfo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableHelper;

use Bartlett\CompatInfo\Reference\ReferenceLoader;
use Bartlett\CompatInfo\Reference\Strategy\PreFetchStrategy;

class ReferenceListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('reference:list')
            ->setDescription('List all references supported.')
            ->addOption(
                'raw',
                null,
                InputOption::VALUE_NONE,
                'Raw list'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $prefetch = new PreFetchStrategy();
        $loader   = new ReferenceLoader;
        $loader->register($prefetch);

        if ($input->getOption('raw')) {
            $text = (string) $loader;
            $output->writeln($text);
        } else {
            $rows = array();
            $refs = $loader->getProvidedReferences();

            $headers = array('References', 'Version', 'Loaded');
            $footers = array(
                sprintf('Total [%d]', count($refs)),
                '',
                ''
            );

            foreach ($refs as $name => $ref) {
                if (isset($ref->loaded)) {
                    $rows[] = array(
                        $ref->name,
                        $ref->version,
                        $ref->loaded,
                    );
                } else {
                    $rows[] = array(
                        $name,
                        '',
                        ''
                    );
                }
            }

            $this->getApplication()
                ->getHelperSet()
                ->get('table2')
                ->setLayout(TableHelper::LAYOUT_COMPACT)
                ->setHeaders($headers)
                ->setFooters($footers)
                ->setRows($rows)
                ->render($output)
            ;
        }
    }
}
