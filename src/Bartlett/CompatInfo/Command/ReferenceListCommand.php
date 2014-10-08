<?php

namespace Bartlett\CompatInfo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

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
            ksort($refs);
            $loaded = 0;

            $headers = array('References', 'Version', 'Loaded');

            foreach ($refs as $name => $ref) {
                $rows[] = array(
                    $ref->name,
                    $ref->version,
                    $ref->loaded,
                );
                if (!empty($ref->loaded)) {
                    $loaded++;
                }
            }

            $footers = array(
                '<info>Total</info>',
                sprintf('<info>[%d]</info>', count($refs)),
                sprintf('<info>[%d]</info>', $loaded)
            );

            $rows[] = new TableSeparator();
            $rows[] = $footers;

            $table = new Table($output);
            $table
                ->setHeaders($headers)
                ->setRows($rows)
                ->setStyle('compact')
            ;
            $table->render();
        }
    }
}
