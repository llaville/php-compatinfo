<?php
/**
 * The CompatInfo CLI version.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableHelper;

/**
 * Console Application.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
class ConsoleApplication extends Application
{
    const VERSION = '@package_version@';

    public function __construct()
    {
        parent::__construct('phpCompatInfo', self::VERSION);

        // The new tableHelper with footers feature
        // @link https://github.com/symfony/Console/pull/10
        $helper = new ConsoleHelper;
        $this->getHelperSet()
            ->set($helper)
        ;
    }

    public function getLongVersion()
    {
        $version = sprintf(
            '<info>%s</info> version <comment>%s</comment>',
            $this->getName(),
            '@' . 'package_version@' == $this->getVersion() ? 'DEV' : $this->getVersion()
        );

        if ('@' . 'git_commit@' !== '@git_commit@') {
            $version .= sprintf(' build <comment>%s</comment>', '@git_commit@');
        }
        return $version;
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
     * @throws \Exception if configuration file does not exists or is invalid
     */
    public function getJsonConfigFile()
    {
        $path = trim(getenv('COMPATINFO')) ? : './compatinfo.json';
        $path = realpath($path);

        if (!is_file($path)) {
            throw new \Exception(
                'Configuration file "' . $path . '" does not exists.'
            );
        }
        $json = file_get_contents($path);
        $var  = json_decode($json, true);

        if (null === $var) {
            throw new \Exception(
                'The json configuration file has an invalid format.'
            );
        }
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
