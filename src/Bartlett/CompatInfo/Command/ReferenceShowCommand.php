<?php

namespace Bartlett\CompatInfo\Command;

use Bartlett\CompatInfo\ConsoleApplication;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

class ReferenceShowCommand extends Command
{
    const FILTER_INI        = 1;
    const FILTER_CONSTANTS  = 2;
    const FILTER_FUNCTIONS  = 4;
    const FILTER_INTERFACES = 8;
    const FILTER_CLASSES    = 16;
    const FILTER_RELEASES   = 32;
    const FILTER_NONE       = 63;

    protected function configure()
    {
        $this
            ->setName('reference:show')
            ->setDescription('Show information about a reference.')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Introspection of a reference (case insensitive)'
            )
            ->addOption(
                'php',
                null,
                InputOption::VALUE_REQUIRED,
                'Filter results on PHP version'
            )
            ->addOption(
                'releases',
                null,
                InputOption::VALUE_NONE,
                'Show releases'
            )
            ->addOption(
                'ini',
                null,
                InputOption::VALUE_NONE,
                'Show ini Entries'
            )
            ->addOption(
                'constants',
                null,
                InputOption::VALUE_NONE,
                'Show constants'
            )
            ->addOption(
                'functions',
                null,
                InputOption::VALUE_NONE,
                'Show functions'
            )
            ->addOption(
                'interfaces',
                null,
                InputOption::VALUE_NONE,
                'Show interfaces'
            )
            ->addOption(
                'classes',
                null,
                InputOption::VALUE_NONE,
                'Show classes'
            )
            ->addOption(
                'raw',
                null,
                InputOption::VALUE_NONE,
                'Raw data'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $refName   = $input->getArgument('name');
        $className = sprintf(
            'Bartlett\\CompatInfo\\Reference\\Extension\\%sExtension',
            ucfirst(strtolower($refName))
        );

        if (class_exists($className) === false) {
            $text = sprintf(
                '<error>Reference %s does not exists</error>',
                $refName
            );
            $output->writeln($text);
            return;
        }

        $reference = new $className;
        if ($input->getOption('raw')) {
            $text = (string) $reference;
            $output->writeln($text);
            return;
        }

        $php = $input->getOption('php');
        if ($php) {
            if (!preg_match(
                '/^\s*(==|!=|[<>]=?)?\s*(.*)$/',
                $php,
                $matches
            )) {
                throw new \InvalidArgumentException(
                    sprintf('Don\'t understand "%s" as a version number.', $php)
                );
            }
            $php = array($matches[1], $matches[2]);
        }

        $filters = 0;
        if ($input->getOption('releases')) {
            $filters += self::FILTER_RELEASES;
        }
        if ($input->getOption('ini')) {
            $filters += self::FILTER_INI;
        }
        if ($input->getOption('constants')) {
            $filters += self::FILTER_CONSTANTS;
        }
        if ($input->getOption('functions')) {
            $filters += self::FILTER_FUNCTIONS;
        }
        if ($input->getOption('interfaces')) {
            $filters += self::FILTER_INTERFACES;
        }
        if ($input->getOption('classes')) {
            $filters += self::FILTER_CLASSES;
        }
        if ($filters === 0) {
            // default to show all categories
            $filters = self::FILTER_NONE;
        }

        if ($filters & self::FILTER_RELEASES) {
            $releases = $reference->getReleases();
            if (count($releases)) {
                $this->render(
                    $output,
                    $releases,
                    $php,
                    'Releases'
                );
            }
        }

        if ($filters & self::FILTER_INI) {
            $iniEntries = $reference->getIniEntries();
            if (count($iniEntries)) {
                $this->render(
                    $output,
                    $iniEntries,
                    $php,
                    'IniEntries'
                );
            }
        }

        if ($filters & self::FILTER_CONSTANTS) {
            $constants = $reference->getConstants();
            if (count($constants)) {
                $this->render(
                    $output,
                    $constants,
                    $php,
                    'Constants'
                );
            }
        }

        if ($filters & self::FILTER_FUNCTIONS) {
            $functions = $reference->getFunctions();
            if (count($functions)) {
                $this->render(
                    $output,
                    $functions,
                    $php,
                    'Functions'
                );
            }
        }

        if ($filters & self::FILTER_INTERFACES) {
            $interfaces = $reference->getInterfaces();
            if (count($interfaces)) {
                $this->render(
                    $output,
                    $interfaces,
                    $php,
                    'Interfaces'
                );
            }
        }

        if ($filters & self::FILTER_CLASSES) {
            $classes = $reference->getClasses();
            if (count($classes)) {
                $this->render(
                    $output,
                    $classes,
                    $php,
                    'Classes'
                );
            }
        }
    }

    protected function render(OutputInterface $output, array $args, $filter, $title)
    {
        $rows = ConsoleApplication::versionHelper($args, $filter);

        $headers = array('', $title, 'REF', 'EXT min/Max', 'PHP min/Max');

        if ($filter) {
            $footers = array(
                '',
                sprintf('<info>Total [%d/%d]</info>', count($rows), count($args)),
                '',
                '',
                ''
            );
        } else {
            $footers = array(
                '',
                sprintf('<info>Total [%d]</info>', count($args)),
                '',
                '',
                ''
            );
        }
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
