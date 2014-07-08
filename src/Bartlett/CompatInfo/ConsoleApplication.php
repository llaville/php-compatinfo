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

use Bartlett\Reflect\Command\ProviderListCommand;
use Bartlett\Reflect\Command\ProviderShowCommand;
use Bartlett\Reflect\Command\ProviderDisplayCommand;
use Bartlett\Reflect\Command\PluginListCommand;

use Bartlett\CompatInfo\Command\ReferenceListCommand;
use Bartlett\CompatInfo\Command\ReferenceShowCommand;
use Bartlett\CompatInfo\Command\AnalyserRunCommand;

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

    /**
     * Initializes the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        $commands   = parent::getDefaultCommands();
        $commands[] = new PluginListCommand;
        $commands[] = new ProviderListCommand;
        $commands[] = new ProviderShowCommand;
        $commands[] = new ProviderDisplayCommand;
        $commands[] = new ReferenceListCommand;
        $commands[] = new ReferenceShowCommand;

        try {
            $var = $this->getJsonConfigFile();
        } catch (\Exception $e) {
            // stop here if json config file is missing or invalid
        }

        if (isset($var['plugins'])) {
            // checks for additional commands

            if (is_array($var['plugins'])) {
                $plugins = $var['plugins'];
            } else {
                $plugins = array($var['plugins']);
            }

            foreach ($plugins as $plugin) {
                if (isset($plugin['class']) && is_string($plugin['class'])) {
                    // try to load the plugin
                    if (class_exists($plugin['class'])) {
                        $cmds = $plugin['class']::getCommands();
                        while (!empty($cmds)) {
                            // add each command provided by the plugin
                            $cmd = array_shift($cmds);
                            if (strpos(get_class($cmd), 'AnalyserRunCommand')) {
                                // replace Reflect Command by CompaInfo Command
                                $cmd = new AnalyserRunCommand;
                            }
                            $commands[] = $cmd;
                        }
                    }
                }
            }
        }

        return $commands;
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
        $path = realpath(getenv('COMPATINFO'));

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

    public static function versionHelper(array $args, $filter)
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

}
