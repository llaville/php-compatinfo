<?php

namespace Bartlett\CompatInfo;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableHelper;

class ConsoleApplication extends Application
{
    const VERSION = '3.0.0RC1';

    public function __construct()
    {
        parent::__construct('phpCompatInfo', self::VERSION);

        // The new tableHelper with footers feature
        $helper = new ConsoleHelper;
        $this->getHelperSet()
            ->set($helper)
        ;
    }

    protected function getDefaultInputDefinition()
    {
        $definition = parent::getDefaultInputDefinition();
        $definition->addOption(
            new InputOption(
                '--profile',
                null,
                InputOption::VALUE_NONE,
                'Display timing and memory usage information.'
            )
        );

        return $definition;
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $exitCode = parent::doRun($input, $output);

        if (true === $input->hasParameterOption('--profile')) {

            if (true === class_exists('\\PHP_Timer')) {
                $text = sprintf(
                    '%s<comment>%s</comment>',
                    PHP_EOL,
                    \PHP_Timer::resourceUsage()
                );
                $output->writeln($text);
            }
        }
        return $exitCode;
    }

    /**
     * Gets the json contents of COMPATINFO configuration file
     *
     * @return array
     */
    public function getJsonConfigFile()
    {
        $path = trim(getenv('COMPATINFO')) ? : './compatinfo.json';
        $json = file_get_contents($path);
        $var  = json_decode($json, true);
        return $var;
    }

    public function versionHelper(array $args, $filter)
    {
        $rows = array();
        ksort($args);

        foreach ($args as $arg => $versions) {
            if ($filter) {
                if (version_compare($versions['php.min'], $filter[1], $filter[0]) === false) {
                    continue;
                }
            }
            $rows[] = array(
                $arg,
                isset($versions['ref']) ? $versions['ref'] : null,
                empty($versions['ext.max'])
                    ? $versions['ext.min']
                    : $versions['ext.min'] . ' => ' . $versions['ext.max'],
                empty($versions['php.max'])
                    ? $versions['php.min']
                    : $versions['php.min'] . ' => ' . $versions['php.max'],
            );
        }
        return $rows;
    }

    public function listHelper(array $args, $versions, $filter, $title)
    {
        $rows = $this->versionHelper($args, $filter);

        $headers = array($title, 'REF', 'EXT min/Max', 'PHP min/Max');

        $versions = empty($versions['php.max'])
            ? $versions['php.min']
            : $versions['php.min'] . ' => ' . $versions['php.max']
        ;

        if ($filter) {
            $footers = array(
                sprintf('Total [%d/%d]', count($rows), count($args)),
                '',
                '',
                $versions
            );
        } else {
            $footers = array(
                sprintf('Total [%d]', count($args)),
                '',
                '',
                $versions
            );
        }

        $table = $this->getHelperSet()
            ->get('table2')
            ->setLayout(TableHelper::LAYOUT_COMPACT)
            ->setHeaders($headers)
            ->setFooters($footers)
            ->setRows($rows)
        ;
        return $table;
    }
}
