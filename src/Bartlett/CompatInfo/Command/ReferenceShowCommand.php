<?php

namespace Bartlett\CompatInfo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableHelper;

class ReferenceShowCommand extends Command
{
    const FILTER_INI        = 1;
    const FILTER_CONSTANTS  = 2;
    const FILTER_FUNCTIONS  = 4;
    const FILTER_INTERFACES = 8;
    const FILTER_CLASSES    = 16;
    const FILTER_NONE       = 31;

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

        $filters = 0;
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

        if ($filters & self::FILTER_INI) {
            $iniEntries = $reference->getIniEntries();
            if (count($iniEntries)) {
                $rows  = $this->getApplication()->versionHelper($iniEntries, $php);
                $this->render($php, $rows, $iniEntries, 'IniEntries')
                    ->render($output)
                ;
            }
        }

        if ($filters & self::FILTER_CONSTANTS) {
            $constants = $reference->getConstants();
            if (count($constants)) {
                $rows  = $this->getApplication()->versionHelper($constants, $php);
                $this->render($php, $rows, $constants, 'Constants')
                    ->render($output)
                ;
            }
        }

        if ($filters & self::FILTER_FUNCTIONS) {
            $functions = $reference->getFunctions();
            if (count($functions)) {
                $rows  = $this->getApplication()->versionHelper($functions, $php);
                $this->render($php, $rows, $functions, 'Functions')
                    ->render($output)
                ;
            }
        }

        if ($filters & self::FILTER_INTERFACES) {
            $interfaces = $reference->getInterfaces();
            if (count($interfaces)) {
                $rows  = $this->getApplication()->versionHelper($interfaces, $php);
                $this->render($php, $rows, $interfaces, 'Interfaces')
                    ->render($output)
                ;
            }
        }

        if ($filters & self::FILTER_CLASSES) {
            $classes = $reference->getClasses();
            if (count($classes)) {
                $rows = $this->getApplication()->versionHelper($classes, $php);
                $this->render($php, $rows, $classes, 'Classes')
                    ->render($output)
                ;
            }
        }
    }

    protected function render(&$php, &$rows, &$results, $title)
    {
        $headers = array($title, 'REF', 'EXT min/Max', 'PHP min/Max');
        
        if ($php) {
            $footers = array(
                sprintf('Total [%d/%d]', count($rows), count($results)),
                '',
                '',
                ''
            );
        } else {
            $footers = array(
                sprintf('Total [%d]', count($results)),
                '',
                '',
                ''
            );
        }

        return $this->getApplication()
            ->getHelperSet()
            ->get('table2')
            ->setLayout(TableHelper::LAYOUT_COMPACT)
            ->setHeaders($headers)
            ->setFooters($footers)
            ->setRows($rows)
        ;
    }
}
