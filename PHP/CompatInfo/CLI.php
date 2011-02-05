<?php
/**
 * Command Line Interpreter version of PHP_CompatInfo
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

require_once 'ezc/Base/base.php';

/**
 * The Command Line Interpreter version provides ability to
 * - list references (extensions, interfaces, classes, functions, constants)
 * - print map detail of a single file or an entire directory
 *
 * Many reports are available:
 * - extension
 * - interface
 * - class
 * - function
 * - constant
 * - source
 * - xml
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_CLI
{
    /**
     * Autoloader for PHP_CompatInfo_CLI
     *
     * @param string $className Name of the class trying to load
     *
     * @return void
     */
    public static function autoload($className)
    {
        static $classes = null;
        static $path    = null;

        if ($classes === null) {
            $classes = array(
                'PHP_CompatInfo'
                    => 'PHP/CompatInfo.php',
                'PHP_CompatInfo_Exception'
                    => 'PHP/CompatInfo/Exception.php',
                'PHP_CompatInfo_Configuration'
                    => 'PHP/CompatInfo/Configuration.php',
                'PHP_CompatInfo_Reference_PHP4'
                    => 'PHP/CompatInfo/Reference/PHP4.php',
                'PHP_CompatInfo_Reference_PHP5'
                    => 'PHP/CompatInfo/Reference/PHP5.php',
                'PHP_CompatInfo_Report_Reference'
                    => 'PHP/CompatInfo/Report/Reference.php',
                'PHP_CompatInfo_Report_Summary'
                    => 'PHP/CompatInfo/Report/Summary.php',
                'PHP_CompatInfo_Report_Extension'
                    => 'PHP/CompatInfo/Report/Extension.php',
                'PHP_CompatInfo_Report_Interface'
                    => 'PHP/CompatInfo/Report/Interface.php',
                'PHP_CompatInfo_Report_Class'
                    => 'PHP/CompatInfo/Report/Class.php',
                'PHP_CompatInfo_Report_Function'
                    => 'PHP/CompatInfo/Report/Function.php',
                'PHP_CompatInfo_Report_Constant'
                    => 'PHP/CompatInfo/Report/Constant.php',
                'PHP_CompatInfo_Report_Xml'
                    => 'PHP/CompatInfo/Report/Xml.php',
                'PHP_CompatInfo_Report_Source'
                    => 'PHP/CompatInfo/Report/Source.php',
                'PHP_CompatInfo_Listener_File'
                    => 'PHP/CompatInfo/Listener/File.php',
                'PHP_CompatInfo_Listener_Growl'
                    => 'PHP/CompatInfo/Listener/Growl.php',
            );
            $path = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;
        }

        if (isset($classes[$className])) {
            include $path . $classes[$className];
        } else {
            ezcBase::autoload($className);
        }
    }

    /**
     * Handle console input and produce the appropriate report requested
     *
     * @return void
     * @throws PHP_CompatInfo_Exception If report is not available.
     */
    public static function main()
    {
        spl_autoload_register('PHP_CompatInfo_CLI::autoload');

        $input = new ezcConsoleInput;

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'help',
                ezcConsoleInput::TYPE_NONE,
                null,
                false,
                'Prints this usage information.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'version',
                ezcConsoleInput::TYPE_NONE,
                null,
                false,
                'Prints the version and exits.',
                '',
                array(),
                array(),
                false,
                false,
                true
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'configuration',
                ezcConsoleInput::TYPE_STRING,
                null,
                false,
                'Read configuration from XML file.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'no-configuration',
                ezcConsoleInput::TYPE_NONE,
                null,
                false,
                'Ignore default configuration file (phpcompatinfo.xml).',
                '',
                array(),
                array(),
                false,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'exclude-pattern',
                ezcConsoleInput::TYPE_STRING,
                null,
                false,
                'Exclude components from list referenced by ID provided.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'verbose',
                ezcConsoleInput::TYPE_NONE,
                null,
                false,
                'Output more verbose information.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'reference',
                ezcConsoleInput::TYPE_STRING,
                null,
                false,
                'The name of the reference to use (PHP4, PHP5 ...).',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'report',
                ezcConsoleInput::TYPE_STRING,
                null,
                false,
                'Type of report (summary, source, function ...).',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'report-file',
                ezcConsoleInput::TYPE_STRING,
                null,
                false,
                'Write the report to the specified file path.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'recursive',
                ezcConsoleInput::TYPE_NONE,
                null,
                false,
                'Includes the contents of subdirectories.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'file-extensions',
                ezcConsoleInput::TYPE_STRING,
                null,
                false,
                'A comma separated list of file extensions to check.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        $input->registerOption(
            new ezcConsoleOption(
                '',
                'ini-set',
                ezcConsoleInput::TYPE_STRING,
                null,
                false,
                'Sets a php.ini directive value.',
                '',
                array(),
                array(),
                true,
                false,
                false
            )
        );

        try {
            $input->process();
        }
        catch (ezcConsoleOptionException $e) {
            print $e->getMessage() . PHP_EOL;
            exit(1);
        }

        $arguments = $input->getArguments();
        $command   = array_shift($arguments);

        if ($input->getOption('help')->value) {
            if (empty($command)) {
                self::printHelp();
            } else {
                self::printModeHelp($command, $input);
            }
            exit(0);

        } elseif ($input->getOption('version')->value) {
            self::printVersion();
            exit(0);
        }

        if (empty($command)) {
            self::printHelp();
            exit(1);
        }

        $warnings = array();

        // Loads the default or custom configuration (if available)
        $options = array(
            'reference' => '',
            'verbose'   => false,
            'listeners' => array()
        );
        $report = '';

        if ($input->getOption('no-configuration')->value === false) {
            if ($input->getOption('configuration')->value === false) {
                // use default configuration
                $filename = 'phpcompatinfo.xml';
                if (file_exists($filename)) {
                    $config = $filename;
                } elseif (file_exists($filename . '.dist')) {
                    $config = $filename . '.dist';
                } else {
                    $config = false;
                }
            } else {
                $filename = $input->getOption('configuration')->value;
                if (file_exists($filename)) {
                    $config = realpath($filename);
                } else {
                    $config = false;
                }
            }
            if ($config) {
                // try to load the configuration file contents
                $configuration = PHP_CompatInfo_Configuration::getInstance($config);

                $patternID = $input->getOption('exclude-pattern')->value;
                // check if components should be excluded
                if ($patternID) {
                    $excludes = $configuration->getExcludeConfiguration($patternID);

                    if (count($excludes) == 0) {
                        $warnings[] = "Exclude pattern ID '$patternID'" .
                            " does not exist, or is empty";
                    } else {
                        $haystack = array(
                            'extension', 'interface', 'function', 'constant'
                        );
                        foreach ($excludes as $key => $values) {
                            if (in_array($key, $haystack)) {
                                $options['exclude'][$key.'s'] = $values;
                            } elseif ('class' == $key) {
                                $options['exclude']['classes'] = $values;
                            } else {
                                foreach ($values as $value) {
                                    $options['exclude']['files'][] = $value;
                                }
                            }
                        }
                    }
                }

                // set main options
                $phpcompatinfo = $configuration->getMainConfiguration();

                if (isset($phpcompatinfo['reference'])) {
                    $options['reference'] = $phpcompatinfo['reference'];
                }
                if (isset($phpcompatinfo['report'])) {
                    $report = $phpcompatinfo['report'];
                }
                if (isset($phpcompatinfo['reportFile'])) {
                    $reportFile = $phpcompatinfo['reportFile'];
                }
                if (isset($phpcompatinfo['reportFileAppend'])) {
                    $reportFileAppend = $phpcompatinfo['reportFileAppend'];
                }
                if (isset($phpcompatinfo['cacheDriver'])) {
                    $options['cacheDriver'] = $phpcompatinfo['cacheDriver'];
                } else {
                    $options['cacheDriver'] = 'null';
                }
                if (isset($phpcompatinfo['consoleProgress'])) {
                    $options['consoleProgress'] = $phpcompatinfo['consoleProgress'];
                }
                if (isset($phpcompatinfo['verbose'])) {
                    $options['verbose'] = $phpcompatinfo['verbose'];
                }
                if (isset($phpcompatinfo['recursive'])) {
                    $options['recursive'] = $phpcompatinfo['recursive'];
                }
                if (isset($phpcompatinfo['fileExtensions'])) {
                    $options['fileExtensions'] = $phpcompatinfo['fileExtensions'];
                }

                // sets cache options
                $options['cacheOptions'] = $configuration->getCacheConfiguration(
                    $options['cacheDriver']
                );

                // sets extension references limit
                $extensions = $configuration->getReferenceConfiguration();
                if (count($extensions) > 0) {
                    $options['extensions'] = $extensions;
                }

                // sets php.ini directives
                $ini = $configuration->getPHPConfiguration();
                foreach ($ini as $name => $value) {
                    ini_set($name, $value);
                }

                // sets listeners instances
                $listeners = $configuration->getListenerConfiguration();
                foreach ($listeners as $listener) {
                    if (!class_exists($listener['class'], false)
                        && $listener['file'] !== ''
                    ) {
                        include_once $listener['file'];
                    }
                    if (class_exists($listener['class'], true)) {
                        if (count($listener['arguments']) == 0) {
                            $listener = new $listener['class'];
                        } else {
                            $listenerClass = new ReflectionClass(
                                $listener['class']
                            );
                            $listener = $listenerClass->newInstanceArgs(
                                $listener['arguments']
                            );
                        }

                        if ($listener instanceof SplObserver) {
                            $options['listeners'][] = $listener;
                        }
                    }
                }

                // sets plugins system
                $plugins = $configuration->getPluginConfiguration();
                foreach ($plugins as $plugin) {
                    if (!class_exists($plugin['class'], false)
                        && $plugin['file'] !== ''
                    ) {
                        include_once $plugin['file'];
                    }
                    if (class_exists($plugin['class'], true)) {
                        $pluginClass = new ReflectionClass($plugin['class']);
                        $reference
                            = $pluginClass->newInstanceArgs($plugin['args']);

                        if (!$reference
                            instanceof PHP_CompatInfo_Reference_PluginsAbstract
                        ) {
                            $warnings[] = "Plugin '" . $plugin['class'] .
                                "' is not valid";
                        }
                        unset($reference);
                    }
                }
                if (count($plugins) > 0) {
                    $options['referencePlugins'] = $plugins;
                }

            } elseif ($input->getOption('verbose')->value) {
                $warnings[] = 'File "' . $filename . '" does not exist';
            }
        }

        if ($input->getOption('ini-set')->value) {
            $ini = explode('=', $input->getOption('ini-set')->value);

            if (isset($ini[0])) {
                if (isset($ini[1])) {
                    ini_set($ini[0], $ini[1]);
                } else {
                    ini_set($ini[0], true);
                }
            }
        }

        if ($input->getOption('report-file')->value) {
            $reportFile       = $input->getOption('report-file')->value;
            $reportFileAppend = false;
        }

        if (isset($reportFile)) {
            if (is_dir($reportFile) || dirname($reportFile) == '.'
                || !file_exists(dirname($reportFile))
            ) {
                $warnings[] = 'Report file: "' . $reportFile . '" is invalid';
            } else {
                $options['reportFile'] = $reportFile;

                if (isset($reportFileAppend) && $reportFileAppend === true) {
                    $options['reportFileFlags'] = FILE_APPEND;
                } else {
                    $options['reportFileFlags'] = 0;
                }
            }
        }

        if ($input->getOption('report')->value) {
            $report = $input->getOption('report')->value;
        }

        if ('print' == $command) {
            $source = array_shift($arguments);
        } elseif ('list' == substr($command, 0, 4)) {
            $extension = array_shift($arguments);
            if (!is_null($extension)) {
                $options['extensions'] = array($extension);
            }
            list(, $source) = explode('-', $command);
            $report = 'reference';
        } else {
            self::printHelp();
            exit(1);
        }

        if ($input->getOption('reference')->value) {
            $options['reference'] = $input->getOption('reference')->value;
        }
        if ($input->getOption('recursive')->value) {
            $options['recursive'] = $input->getOption('recursive')->value;
        }
        if ($input->getOption('file-extensions')->value) {
            $fileExtensions = explode(
                ',', $input->getOption('file-extensions')->value
            );
            $options['fileExtensions'] = array_map('trim', $fileExtensions);
        }

        if ($input->getOption('verbose')->value) {
            $options['verbose'] = (bool)$input->getOption('verbose')->value;
        }

        try {
            self::factory($report, $source, $options, $warnings);

        } catch (PHP_CompatInfo_Exception $e) {
            print $e->getMessage() . PHP_EOL;
            exit(1);
        }
    }

    /**
     * Produce the appropriate report object based on $report parameter
     *
     * @param string $report   Type of report requested
     * @param string $source   Data source or command list suffix
     * @param array  $options  Options for parser
     * @param array  $warnings List of warning messages already produced
     *
     * @return PHP_CompatInfo_Report
     * @throws PHP_CompatInfo_Exception If report is not available.
     */
    public static function factory($report, $source, $options, $warnings)
    {
        $reportClassName = 'PHP_CompatInfo_Report_' . ucfirst($report);
        if (!class_exists($reportClassName, true)) {
            throw new PHP_CompatInfo_Exception(
                'Report type "' . $report . '" not found.'
            );
        }
        $reportClass = new $reportClassName($source, $options, $warnings);
        return $reportClass;
    }

    /**
     * Prints the help
     *
     * @return void
     */
    protected static function printHelp()
    {
        self::printVersion();

        print <<<EOT

Usage: phpci <options> <command>

  --help                Prints this usage information.
  --version             Prints the version and exits.

  --configuration       Read configuration from XML file.
  --no-configuration    Ignore default configuration file (phpcompatinfo.xml).
  --ini-set             Sets a php.ini directive value.

  --verbose             Output more verbose information.

For single command help type:
    phpci --help <command>

Available commands:
  * print               Print a report of data source parsed.
  * list-all            List all components referenced in the data base.
  * list-extensions     List all extensions referenced in the data base.
  * list-interfaces     List all interfaces referenced in the data base.
  * list-classes        List all classes referenced in the data base.
  * list-functions      List all functions referenced in the data base.
  * list-constants      List all constants referenced in the data base.

EOT;
    }

    /**
     * Prints the help text for a single command
     *
     * @param string $command The command
     * @param object $input   Instance of ezcConsoleInput (console input handler)
     *
     * @return void
     */
    protected static function printModeHelp($command, $input)
    {
        printf(
            'Command line options and arguments for "%s"%s',
            $command,
            PHP_EOL
        );

        switch ($command) {
        case 'print':
            $params = array(
                'reference',
                'report',
                'report-file',
                'exclude-pattern',
                'recursive',
                'file-extensions',
            );
            break;
        case 'list-all':
        case 'list-extensions':
        case 'list-interfaces':
        case 'list-classes':
        case 'list-functions':
        case 'list-constants':
            $params = array('reference', 'report-file');
            break;
        default:
            $params = array('reference');
            break;
        }
        foreach ($input->getHelp(false, $params) as $param) {
            printf(
                '  %-19s %s%s',
                $param[0],
                $param[1],
                PHP_EOL
            );
        }
    }

    /**
     * Prints the version
     *
     * @return void
     */
    protected static function printVersion()
    {
        print 'PHPCompatInfo (cli) @package_version@ by Laurent Laville.' . PHP_EOL;
    }

}
