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
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */


/**
 * The Command Line Interpreter version provides ability to
 * - list references (extensions, interfaces, classes, functions, constants)
 * - print map detail of a single file or an entire directory
 *
 * Many reports are available:
 * - extension
 * - namespace
 * - trait
 * - interface
 * - class
 * - function
 * - constant
 * - global
 * - summary
 * - source
 * - xml
 * - token
 * - condition
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
     * Current version of PHP_CompatInfo
     * @var string
     */
    const VERSION = '@package_version@';

    /**
     * Gets current version of PHP_CompatInfo
     *
     * @return string
     */
    public static function getVersion()
    {
        if (strpos(self::VERSION, '@') === 0) {
            $version = 'DEV';
        } else {
            $version = self::VERSION;
        }
        return $version;
    }

    /**
     * Handle console input and produce the appropriate report requested
     *
     * @return void
     * @throws PHP_CompatInfo_Exception If report is not available.
     */
    public static function main()
    {
        $input = new Console_CommandLine(
            array(
                'name'        => 'phpci',
                'description' => 'PHPCompatInfo (cli) by Laurent Laville.',
                'version'     => self::getVersion()
            )
        );

        // common options to all sub-commands
        $input->addOption(
            'xmlFile',
            array(
                'long_name'   => '--configuration',
                'action'      => 'StoreString',
                'description' => 'Read configuration from XML file'
            )
        );
        $input->addOption(
            'noConfiguration',
            array(
                'long_name'   => '--no-configuration',
                'action'      => 'StoreTrue',
                'description' => 'Ignore default configuration file ' .
                                 '(phpcompatinfo.xml)'
            )
        );
        $input->addOption(
            'iniSet',
            array(
                'short_name'  => '-d',
                'long_name'   => '--ini-set',
                'action'      => 'StoreArray',
                'description' => 'Sets a php.ini directive value'
            )
        );
        $input->addOption(
            'verbose',
            array(
                'short_name'  => '-v',
                'long_name'   => '--verbose',
                'action'      => 'Counter',
                'description' => 'Output more verbose information'
            )
        );

        // options relatives and common to sub-commands
        $referenceOption = new Console_CommandLine_Option(
            'reference',
            array(
                'long_name'   => '--reference',
                'action'      => 'StoreString',
                'description' => 'The name of the reference to use',
                'choices'     => array('PHP4', 'PHP5', 'ALL'),
            )
        );
        $reportOption = new Console_CommandLine_Option(
            'report',
            array(
                'long_name'   => '--report',
                'action'      => 'StoreArray',
                'description' => 'Type of report',
                'choices'     => array(
                    'full', 'summary', 'source', 'xml', 'token',
                    'extension',
                    'namespace',
                    'trait', 'interface', 'class', 'function', 'constant',
                    'global', 'condition'
                )
            )
        );
        $helpReferenceOption = new Console_CommandLine_Option(
            'helpReference',
            array(
                'long_name'     => '--help-reference',
                'action'        => 'List',
                'description'   => 'List of reference available',
                'action_params' => array(
                    'list' => array(
                        'PHP4', 'PHP5', 'ALL'
                    ),
                )
            )
        );
        $helpReportOption = new Console_CommandLine_Option(
            'helpReport',
            array(
                'long_name'     => '--help-report',
                'action'        => 'List',
                'description'   => 'List of report available',
                'action_params' => array(
                    'list' => array(
                        'full', 'summary', 'source', 'xml', 'token',
                        'extension',
                        'namespace',
                        'trait', 'interface', 'class', 'function', 'constant',
                        'global', 'condition'
                    ),
                )
            )
        );
        $reportFileOption = new Console_CommandLine_Option(
            'reportFile',
            array(
                'long_name'   => '--report-file',
                'action'      => 'StoreString',
                'description' => 'Write the report to the specified file path',
            )
        );
        $excludeIDOption = new Console_CommandLine_Option(
            'excludeID',
            array(
                'long_name'   => '--exclude-pattern',
                'action'      => 'StoreString',
                'description' => 'Exclude components' .
                                 ' from list referenced by ID provided'
            )
        );
        $recursiveOption = new Console_CommandLine_Option(
            'recursive',
            array(
                'short_name'  => '-R',
                'long_name'   => '--recursive',
                'action'      => 'StoreTrue',
                'description' => 'Includes the contents of subdirectories'
            )
        );
        $fileExtensionsOption = new Console_CommandLine_Option(
            'fileExtensions',
            array(
                'long_name'   => '--file-extensions',
                'action'      => 'StoreString',
                'description' => 'A comma separated list of file extensions to check'
            )
        );

        // options relatives to print sub-command
        $filterVersionOption = new Console_CommandLine_Option(
            'filterVersion',
            array(
                'long_name'   => '--filter-version',
                'action'      => 'StoreString',
                'description' => 'The version to compare with each element found',
            )
        );
        $filterOperatorOption = new Console_CommandLine_Option(
            'filterOperator',
            array(
                'long_name'   => '--filter-operator',
                'action'      => 'StoreString',
                'description' => 'The version test relationship',
                'choices'     => array('lt', 'le', 'gt', 'ge', 'eq', 'ne')
            )
        );

        // argument common to all list sub-commands except to list and list-references
        $referenceArgument = new Console_CommandLine_Argument(
            'reference',
            array(
                'description' => '(optional) Limit output only to this reference',
                'optional'    => true
            )
        );

        // clear-cache sub-command
        $clearcacheCmd = $input->addCommand(
            'clear-cache',
            array(
                'description' => 'Clear Parser Cache'
            )
        );
        $clearcacheCmd->addArgument(
            'sourceFile',
            array(
                'description' => 'The source file in cache entries to delete.',
                'optional'    => true
            )
        );

        // print sub-command
        $printCmd = $input->addCommand(
            'print',
            array(
                'description' => 'Print a report of data source parsed.'
            )
        );
        $printCmd->addOption($referenceOption);
        $printCmd->addOption($reportOption);
        $printCmd->addOption($reportFileOption);
        $printCmd->addOption($excludeIDOption);
        $printCmd->addOption($recursiveOption);
        $printCmd->addOption($fileExtensionsOption);
        $printCmd->addOption($filterVersionOption);
        $printCmd->addOption($filterOperatorOption);
        $printCmd->addOption($helpReferenceOption);
        $printCmd->addOption($helpReportOption);
        $printCmd->addArgument(
            'sourcePath',
            array(
                'description' => 'The data source to scan (file or directory).'
            )
        );

        // list-references sub-command
        $listReferencesCmd = $input->addCommand(
            'list-references',
            array(
                'description' => 'List all extensions supported.'
            )
        );
        $listReferencesCmd->addOption($filterVersionOption);
        $listReferencesCmd->addOption($filterOperatorOption);
        $listReferencesCmd->addOption($reportFileOption);
        $listReferencesCmd->addArgument($referenceArgument);

        // list sub-command
        $listCmd = $input->addCommand(
            'list',
            array(
                'description' => 'List all "elements" referenced in the data base.'
            )
        );
        $listCmd->addOption($referenceOption);
        $listCmd->addOption($filterVersionOption);
        $listCmd->addOption($filterOperatorOption);
        $listCmd->addOption($reportFileOption);
        $listCmd->addOption($helpReferenceOption);
        $listCmd->addArgument(
            'element',
            array(
                'description' => 'May be either ' .
                                 '"extensions", ' .
                                 '"interfaces", "classes", ' .
                                 '"functions" or "constants"',
                'choices'     => array(
                    'extensions', 'interfaces', 'classes', 'functions', 'constants'
                ),
                'multiple'    => true
            )
        );

        // list-extensions sub-command
        $listExtensionsCmd = $input->addCommand(
            'list-extensions',
            array(
                'description' => 'List all extensions referenced in the data base.'
            )
        );
        $listExtensionsCmd->addOption($referenceOption);
        $listExtensionsCmd->addOption($filterVersionOption);
        $listExtensionsCmd->addOption($filterOperatorOption);
        $listExtensionsCmd->addOption($reportFileOption);
        $listExtensionsCmd->addOption($helpReferenceOption);
        $listExtensionsCmd->addArgument($referenceArgument);

        // list-interfaces sub-command
        $listInterfacesCmd = $input->addCommand(
            'list-interfaces',
            array(
                'description' => 'List all interfaces referenced in the data base.'
            )
        );
        $listInterfacesCmd->addOption($referenceOption);
        $listInterfacesCmd->addOption($filterVersionOption);
        $listInterfacesCmd->addOption($filterOperatorOption);
        $listInterfacesCmd->addOption($reportFileOption);
        $listInterfacesCmd->addOption($helpReferenceOption);
        $listInterfacesCmd->addArgument($referenceArgument);

        // list-classes sub-command
        $listClassesCmd = $input->addCommand(
            'list-classes',
            array(
                'description' => 'List all classes referenced in the data base.'
            )
        );
        $listClassesCmd->addOption($referenceOption);
        $listClassesCmd->addOption($filterVersionOption);
        $listClassesCmd->addOption($filterOperatorOption);
        $listClassesCmd->addOption($reportFileOption);
        $listClassesCmd->addOption($helpReferenceOption);
        $listClassesCmd->addArgument($referenceArgument);

        // list-functions sub-command
        $listFunctionsCmd = $input->addCommand(
            'list-functions',
            array(
                'description' => 'List all functions referenced in the data base.'
            )
        );
        $listFunctionsCmd->addOption($referenceOption);
        $listFunctionsCmd->addOption($filterVersionOption);
        $listFunctionsCmd->addOption($filterOperatorOption);
        $listFunctionsCmd->addOption($reportFileOption);
        $listFunctionsCmd->addOption($helpReferenceOption);
        $listFunctionsCmd->addArgument($referenceArgument);

        // list-constants sub-command
        $listConstantsCmd = $input->addCommand(
            'list-constants',
            array(
                'description' => 'List all constants referenced in the data base.'
            )
        );
        $listConstantsCmd->addOption($referenceOption);
        $listConstantsCmd->addOption($filterVersionOption);
        $listConstantsCmd->addOption($filterOperatorOption);
        $listConstantsCmd->addOption($reportFileOption);
        $listConstantsCmd->addOption($helpReferenceOption);
        $listConstantsCmd->addArgument($referenceArgument);


        try {
            $result = $input->parse();
            $command = $result->command_name;

            if (empty($command)) {
                $input->displayUsage(1);
            }
        }
        catch (Exception $e) {
            $input->displayError($e->getMessage());
        }

        $warnings = array();

        // Loads the default or custom configuration (if available)
        $options = array(
            'reference' => '',
            'verbose'   => false,
            'listeners' => array()
        );
        $reports = array();

        $consoleProgress  = true;
        $reportFileAppend = false;

        if ($result->options['noConfiguration'] !== true) {
            if (!isset($result->options['xmlFile'])) {
                // use default configuration
                $dir = '@cfg_dir@' . DIRECTORY_SEPARATOR . 'PHP_CompatInfo';
                if (strpos($dir, '@') === false) {
                    // PEAR installer was used to install the package
                } else {
                    // manual install
                    $dir = getcwd();
                }
                $filename = $dir . DIRECTORY_SEPARATOR . 'phpcompatinfo.xml';
                if (file_exists($filename)) {
                    $config = $filename;
                } elseif (file_exists($filename . '.dist')) {
                    $config = $filename . '.dist';
                } else {
                    $config = false;
                }
            } else {
                $filename = $result->options['xmlFile'];
                if (file_exists($filename)) {
                    $config = realpath($filename);
                } else {
                    $config = false;
                }
            }
            if ($config && is_file($config)) {
                // try to load the configuration file contents
                $configuration = PHP_CompatInfo_Configuration::getInstance($config);

                // check if components should be excluded
                if (isset($result->command->options['excludeID'])) {
                    $patternID = $result->command->options['excludeID'];
                    $excludes  = $configuration->getExcludeConfiguration($patternID);

                    if (count($excludes) == 0) {
                        $warnings[] = "Exclude pattern ID '$patternID'" .
                            " does not exist, or is empty";
                    } else {
                        $haystack = array(
                            'extension',
                            'interface', 'trait',
                            'function', 'constant'
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
                    $reports = $phpcompatinfo['report'];
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
                    $consoleProgress = $phpcompatinfo['consoleProgress'];
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

                        if ($listener instanceof PHP_CompatInfo_Listener_Console
                            && $consoleProgress === false) {
                            /*
                                Do not add the console listener
                                if consoleProgress directive is off
                            */
                        } else {
                            if ($listener instanceof SplObserver) {
                                $options['listeners'][] = $listener;
                            }
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

            } elseif (isset($result->options['verbose'])) {
                $warnings[] = 'File "' . $filename . '" does not exist';
            }
        }

        if ($consoleProgress === true) {
            $options['listeners'][] = new PHP_CompatInfo_Listener_Console;
        }

        if (isset($result->command->options['reference'])) {
            $options['reference'] = $result->command->options['reference'];
        }
        if (empty($options['reference'])
            && !in_array($command, array('list-references', 'clear-cache'))
        ) {
            $input->displayError('You must supply at least a reference');
        }

        if (isset($result->options['iniSet'])) {
            foreach ($result->options['iniSet'] as $iniSet) {
                $ini = explode('=', $iniSet);

                if (isset($ini[0])) {
                    if (isset($ini[1])) {
                        ini_set($ini[0], $ini[1]);
                    } else {
                        ini_set($ini[0], true);
                    }
                }
            }
        }

        if (isset($result->command->options['report'])) {
            $reports = $result->command->options['report'];
        }

        if (in_array('full', $reports)) {
            $reports = array(
                'summary', 'extension',
                'interface', 'trait', 'class', 'function', 'constant',
                'global', 'token', 'condition'
            );
            $reportFileAppend = true;
        }

        if (isset($result->command->options['reportFile'])) {
            $reportFile = $result->command->options['reportFile'];
        }

        if (isset($reportFile)) {
            if (is_dir($reportFile)
                || !file_exists(dirname($reportFile))
            ) {
                $warnings[] = 'Report file: "' . $reportFile . '" is invalid';
            } else {
                $options['reportFile'] = $reportFile;

                if ($reportFileAppend === true) {
                    $options['reportFileFlags'] = FILE_APPEND;
                } else {
                    $options['reportFileFlags'] = 0;
                }
            }
        }

        if (isset($result->command->options['filterVersion'])) {
            $options['filterVersion'] = $result->command->options['filterVersion'];
        }
        if (isset($result->command->options['filterOperator'])) {
            $options['filterOperator'] = $result->command->options['filterOperator'];
        }

        if ('print' == $command) {
            if (count($reports) == 0) {
                $input->displayError('You must supply at least a type of report');
            }
            $source = $result->command->args['sourcePath'];

        } elseif ('list' == $command) {
            $elements = $result->command->args['element'];
            $source   = array_shift($elements);
            $reports  = array('reference');

            $options['filterReference'] = null;

        } elseif ('list' == substr($command, 0, 4)) {
            list(, $source) = explode('-', $command);
            if ($source == 'references') {
                $reports = array('database');
            } else {
                $reports  = array('reference');
                $elements = array();
            }
            $options['filterReference'] = $result->command->args['reference'];
        }

        if (isset($result->command->options['recursive'])) {
            $options['recursive'] = $result->command->options['recursive'];
        }
        if (isset($result->command->options['fileExtensions'])) {
            $fileExtensions = explode(
                ',', $result->command->options['fileExtensions']
            );
            $options['fileExtensions'] = array_map('trim', $fileExtensions);
        }

        if (isset($result->options['verbose'])) {
            $options['verbose'] = $result->options['verbose'];
        }

        if ('clear-cache' == $command) {

            $defaultOptions = PHP_CompatInfo::getDefaultOptions();

            $driver = isset($options['cacheDriver'])
                ? $options['cacheDriver'] : $defaultOptions['cacheDriver'];
            $source = $result->command->args['sourceFile'];

            $cache = PHP_CompatInfo_Cache::getInstance($driver, $defaultOptions);
            $count = $cache->deleteCache($source);
            printf('%d cache entries cleared%s', $count, PHP_EOL);

        } else {
            try {
                foreach ($reports as $report) {
                    self::factory($report, $source, $options, $warnings);
                    if ($report == 'reference') {
                        $options['reportFileFlags'] = FILE_APPEND;
                        while (count($elements) > 0) {
                            $source = array_shift($elements);
                            self::factory($report, $source, $options, $warnings);
                        }
                    }
                }

            } catch (PHP_CompatInfo_Exception $e) {
                print $e->getMessage() . PHP_EOL;
                exit(1);
            }
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

}
