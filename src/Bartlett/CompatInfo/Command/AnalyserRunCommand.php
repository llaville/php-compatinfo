<?php

namespace Bartlett\CompatInfo\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Helper\ProgressHelper;

use Bartlett\CompatInfo;
use Bartlett\Reflect\Command\ProviderCommand;
use Bartlett\Reflect\ProviderManager;
use Bartlett\Reflect\Provider\SymfonyFinderProvider;
use Bartlett\Reflect\Plugin\Analyser\AnalyserPlugin;

class AnalyserRunCommand extends ProviderCommand
{
    protected function configure()
    {
        $this
            ->setName('analyser:run')
            ->setDescription('Analyse a data source and display results.')
            ->addArgument(
                'source',
                InputArgument::REQUIRED,
                'Path to the data source or its alias'
            )
            ->addArgument(
                'analysers',
                InputArgument::IS_ARRAY,
                'Add one or more analyser to run at end of process (case insensitive).'
            )
            ->addOption(
                'alias',
                null,
                InputOption::VALUE_NONE,
                'If set, the source refers to its alias'
            )
            ->addOption(
                'php',
                null,
                InputOption::VALUE_REQUIRED,
                'Filter results on PHP version'
            )
            ->addOption(
                'redraw-freq',
                null,
                InputOption::VALUE_REQUIRED,
                'How many times should the progress bar be updated?',
                1
            )
        ;
    }

    /**
     *
     * @throws \InvalidArgumentException if an analyser required is not installed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = trim($input->getArgument('source'));
        if ($input->getOption('alias')) {
            $alias = $source;
        } else {
            $alias = false;
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

        $analysers = $input->getArgument('analysers');

        $var = $this->getApplication()->getJsonConfigFile();

        if (!is_array($var)
            || !isset($var['source-providers'])
        ) {
            throw new \Exception(
                'The compatinfo.json file has an invalid format'
            );
        }

        if (is_array($var['source-providers'])) {
            $providers = $var['source-providers'];
        } else {
            $providers = array($var['source-providers']);
        }

        if (is_array($var['analysers'])) {
            $analysersInstalled = $var['analysers'];
        } else {
            $analysersInstalled = array($var['analysers']);
        }

        $plugins = array();
        foreach ($analysers as $analyser) {
            $found = false;
            foreach ($analysersInstalled as $analyserInstalled) {
                if (strcasecmp($analyserInstalled['name'], $analyser) === 0) {
                    // analyser installed and available
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Analyser "%s" is not installed. Checks with analyser:list command.',
                        $analyser
                    )
                );
            }
            $plugins[] = new $analyserInstalled['class'];
        }
        if (empty($analysers)) {
            // at least, there is always this analyser to check dependencies and versions
            $plugins[]   = new CompatInfo\Analyser\SummaryAnalyser;
            $analysers[] = 'summary';
        }

        foreach ($providers as $provider) {
            if ($this->findProvider($provider, $source, $alias) === false) {
                continue;
            }

            if ($output->isQuiet()) {
                $progress = false;
            } else {
                $progress = $this->getApplication()
                    ->getHelperSet()
                    ->get('progress')
                ;

                if ($freq = $input->getOption('redraw-freq')) {
                    $progress->setRedrawFrequency($freq);
                }

                $max = $this->finder->count();
                $progress->start($output, $max);
            }

            $pm = new ProviderManager;
            $pm->set('DataSource', new SymfonyFinderProvider($this->finder));

            $compatinfo = new CompatInfo;
            $compatinfo->setProviderManager($pm);

            if (count($plugins)) {
                $analyser = new AnalyserPlugin($plugins);
                $compatinfo->addPlugin($analyser);
            }


            $compatinfo->parse();

            if ($progress instanceof ProgressHelper) {
                $progress->clear();
                $progress->finish();
            }

            $metrics = $compatinfo->getMetrics();
            if (!$metrics) {
                // No reports printed if there are no metrics.
                return;
            }

            $analysers = array_map('strtolower', $analysers);
            $count = $metrics['DataSource'];

            if ($count['directories'] > 0) {
                $text = sprintf(
                    "\n" .
                    "Directories                                 %10d\n" .
                    "Files                                       %10d\n",
                    $count['directories'],
                    $count['files']
                );
            }
            if (in_array('structure', $analysers)
                && $count['testClasses'] > 0
            ) {
                $text .= sprintf(
                    "\nTests\n" .
                    "  Classes                                   %10d\n" .
                    "  Methods                                   %10d\n",
                    $count['testClasses'],
                    $count['testMethods']
                );
            }
            $output->writeln('<info>Data Source Analysed</info>');
            $output->writeln($text);

            if (in_array('summary', $analysers)) {
                $output->writeln("<info>Summary Analysis</info>");
                #$table = $this->summaryAnalyser($count);
                #$table->render($output);
                $text = $this->summaryAnalyser($count);
                $output->writeln($text);
            }

            if (in_array('interface', $analysers)) {
                $output->writeln("<info>Interfaces Analysis</info>\n");
                $table = $this->interfaceAnalyser($count, $php);
                $table->render($output);
                $output->writeln('');
            }
            
            if (in_array('trait', $analysers)) {
                $output->writeln("<info>Traits Analysis</info>\n");
                $table = $this->traitAnalyser($count, $php);
                $table->render($output);
                $output->writeln('');
            }
            
            if (in_array('class', $analysers)) {
                $output->writeln("<info>Classes Analysis</info>\n");
                $table = $this->classAnalyser($count, $php);
                $table->render($output);
                $output->writeln('');
            }

            if (in_array('function', $analysers)) {
                $output->writeln("<info>Functions Analysis</info>\n");
                $table = $this->functionAnalyser($count, $php);
                $table->render($output);
                $output->writeln('');
            }

            if (in_array('constant', $analysers)) {
                $output->writeln("<info>Constants Analysis</info>\n");
                $table = $this->constantAnalyser($count, $php);
                $table->render($output);
                $output->writeln('');
            }
            
            if (in_array('size', $analysers)) {
                $text = $this->sizeAnalyser($count);
                $output->writeln('<info>Size Analysis</info>');
                $output->writeln($text);
            }

            if (in_array('complexity', $analysers)) {
                $text = $this->complexityAnalyser($count);
                $output->writeln('<info>Complexity Analysis</info>');
                $output->writeln($text);
            }

            if (in_array('dependency', $analysers)) {
                $text = $this->dependencyAnalyser($count);
                $output->writeln('<info>Dependency Analysis</info>');
                $output->writeln($text);
            }

            if (in_array('structure', $analysers)) {
                $text = $this->structureAnalyser($count);
                $output->writeln('<info>Structure Analysis</info>');
                $output->writeln($text);
            }
            return;
        }

        throw new \Exception(
            'None data source matching'
        );
    }

    private function summaryAnalyser($metric)
    {
        $format = <<<END

Summary
  Extensions                                %10d
  Namespaces                                %10d
  Interfaces                                %10d
  Traits                                    %10d
  Classes                                   %10d
  Methods                                   %10d
  Functions                                 %10d
  Constants                                 %10d
  Internal Functions                        %10d

Versions
  PHP min                                   %10s
  PHP max                                   %10s

END;

        $str = sprintf(
            $format,
            count($metric['sa.extensions']),
            $metric['namespaces'],
            count($metric['sa.interfaces']),
            count($metric['sa.traits']),
            count($metric['sa.classes']),
            count($metric['sa.methods']),
            count($metric['sa.functions']),
            count($metric['sa.constants']),
            count($metric['sa.internals']),
            $metric['sa.versions']['php.min'],
            $metric['sa.versions']['php.max']
        );
        return $str;
    }

    private function interfaceAnalyser($metric, $php)
    {
        $table = $this->getApplication()
            ->listHelper($metric['ia.interfaces'], $metric['ia.versions'], $php, 'Interface');
        return $table;
    }

    private function traitAnalyser($metric, $php)
    {
        $table = $this->getApplication()
            ->listHelper($metric['ta.traits'], $metric['ta.versions'], $php, 'Trait');
        return $table;
    }

    private function classAnalyser($metric, $php)
    {
        $table = $this->getApplication()
            ->listHelper($metric['cla.classes'], $metric['cla.versions'], $php, 'Class');
        return $table;
    }

    private function functionAnalyser($metric, $php)
    {
        $table = $this->getApplication()
            ->listHelper($metric['fa.functions'], $metric['fa.versions'], $php, 'Function');
        return $table;
    }
    
    private function constantAnalyser($metric, $php)
    {
        $table = $this->getApplication()
            ->listHelper($metric['ca.constants'], $metric['ca.versions'], $php, 'Constant');
        return $table;
    }
    
    private function sizeAnalyser($count)
    {
        $count['ncloc']         = $count['loc'] - $count['cloc'];
        $count['llocGlobal']    = $count['lloc'] -
            $count['llocClasses'] -
            $count['llocFunctions'];

        $format = <<<END

  Lines of Code (LOC)                       %10d
  Comment Lines of Code (CLOC)              %10d (%.2f%%)
  Non-Comment Lines of Code (NCLOC)         %10d (%.2f%%)
  Logical Lines of Code (LLOC)              %10d (%.2f%%)
    Classes                                 %10d (%.2f%%)
      Average Class Length                  %10d
      Average Method Length                 %10d
    Functions                               %10d (%.2f%%)
      Average Function Length               %10d
    Not in classes or functions             %10d (%.2f%%)

END;

        $str = sprintf(
            $format,
            $count['loc'],
            $count['cloc'],
            $count['loc'] > 0 ? ($count['cloc'] / $count['loc']) * 100 : 0,
            $count['ncloc'],
            $count['loc'] > 0 ? ($count['ncloc'] / $count['loc']) * 100 : 0,
            $count['lloc'],
            $count['loc'] > 0 ? ($count['lloc'] / $count['loc']) * 100 : 0,
            $count['llocClasses'],
            $count['lloc'] > 0 ? ($count['llocClasses'] / $count['lloc']) * 100 : 0,
            $count['classes'] > 0 ? $count['llocClasses'] / $count['classes'] : 0,
            $count['methods'] > 0 ? $count['llocClasses'] / $count['methods'] : 0,
            $count['llocFunctions'],
            $count['lloc'] > 0 ? ($count['llocFunctions'] / $count['lloc']) * 100 : 0,
            $count['functions'] > 0 ? $count['llocFunctions'] / $count['functions'] : 0,
            $count['llocGlobal'],
            $count['lloc'] > 0 ? ($count['llocGlobal'] / $count['lloc']) * 100 : 0
        );
        return $str;
    }

    private function complexityAnalyser($count)
    {
        $format = <<<END

Complexity
  Cyclomatic Complexity / LLOC              %10.2f
  Cyclomatic Complexity / Number of Methods %10.2f

END;

        $str = sprintf(
            $format,
            $count['lloc'] > 0 ? ($count['ccn'] / $count['lloc']) : 0,
            $count['methods'] > 0 ? ($count['methods'] + $count['ccnMethods']) / $count['methods'] : 0
        );
        return $str;
    }

    private function dependencyAnalyser($count)
    {
        $count['globalAccesses'] = $count['globalConstantAccesses'] +
                                   $count['globalVariableAccesses'] +
                                   $count['superGlobalVariableAccesses'];

        $count['attributeAccesses'] = $count['staticAttributeAccesses'] +
                                      $count['instanceAttributeAccesses'];

        $count['methodCalls']       = $count['staticMethodCalls'] +
                                      $count['instanceMethodCalls'];

        $format = <<<END

Dependencies
  Global Accesses                           %10d
    Global Constants                        %10d (%.2f%%)
    Global Variables                        %10d (%.2f%%)
    Super-Global Variables                  %10d (%.2f%%)
  Attribute Accesses                        %10d
    Non-Static                              %10d (%.2f%%)
    Static                                  %10d (%.2f%%)
  Method Calls                              %10d
    Non-Static                              %10d (%.2f%%)
    Static                                  %10d (%.2f%%)

END;

        $str = sprintf(
            $format,
            $count['globalAccesses'],
            $count['globalConstantAccesses'],
            $count['globalAccesses'] > 0 ? ($count['globalConstantAccesses'] / $count['globalAccesses']) * 100 : 0,
            $count['globalVariableAccesses'],
            $count['globalAccesses'] > 0 ? ($count['globalVariableAccesses'] / $count['globalAccesses']) * 100 : 0,
            $count['superGlobalVariableAccesses'],
            $count['globalAccesses'] > 0 ? ($count['superGlobalVariableAccesses'] / $count['globalAccesses']) * 100 : 0,
            $count['attributeAccesses'],
            $count['instanceAttributeAccesses'],
            $count['attributeAccesses'] > 0 ? ($count['instanceAttributeAccesses'] / $count['attributeAccesses']) * 100 : 0,
            $count['staticAttributeAccesses'],
            $count['attributeAccesses'] > 0 ? ($count['staticAttributeAccesses'] / $count['attributeAccesses']) * 100 : 0,
            $count['methodCalls'],
            $count['instanceMethodCalls'],
            $count['methodCalls'] > 0 ? ($count['instanceMethodCalls'] / $count['methodCalls']) * 100 : 0,
            $count['staticMethodCalls'],
            $count['methodCalls'] > 0 ? ($count['staticMethodCalls'] / $count['methodCalls']) * 100 : 0
        );
        return $str;
    }

    private function structureAnalyser($count)
    {
        $count['constants'] = $count['classConstants'] + $count['globalConstants'];

        $format = <<<END

  Namespaces                                %10d
  Interfaces                                %10d
  Traits                                    %10d
  Classes                                   %10d
    Abstract Classes                        %10d (%.2f%%)
    Concrete Classes                        %10d (%.2f%%)
  Methods                                   %10d
    Scope
      Non-Static Methods                    %10d (%.2f%%)
      Static Methods                        %10d (%.2f%%)
    Visibility
      Public Method                         %10d (%.2f%%)
      Protected Method                      %10d (%.2f%%)
      Private Method                        %10d (%.2f%%)
  Functions                                 %10d
    Named Functions                         %10d (%.2f%%)
    Anonymous Functions                     %10d (%.2f%%)
  Constants                                 %10d
    Global Constants                        %10d (%.2f%%)
    Class Constants                         %10d (%.2f%%)

END;

        $str = sprintf(
            $format,
            $count['namespaces'],
            $count['interfaces'],
            $count['traits'],
            $count['classes'],
            $count['abstractClasses'],
            $count['classes'] > 0 ? ($count['abstractClasses'] / $count['classes']) * 100 : 0,
            $count['concreteClasses'],
            $count['classes'] > 0 ? ($count['concreteClasses'] / $count['classes']) * 100 : 0,
            $count['methods'],
            $count['nonStaticMethods'],
            $count['methods'] > 0 ? ($count['nonStaticMethods'] / $count['methods']) * 100 : 0,
            $count['staticMethods'],
            $count['methods'] > 0 ? ($count['staticMethods'] / $count['methods']) * 100 : 0,
            $count['publicMethods'],
            $count['methods'] > 0 ? ($count['publicMethods'] / $count['methods']) * 100 : 0,
            $count['protectedMethods'],
            $count['methods'] > 0 ? ($count['protectedMethods'] / $count['methods']) * 100 : 0,
            $count['privateMethods'],
            $count['methods'] > 0 ? ($count['privateMethods'] / $count['methods']) * 100 : 0,
            $count['functions'],
            $count['namedFunctions'],
            $count['functions'] > 0 ? ($count['namedFunctions'] / $count['functions']) * 100 : 0,
            $count['anonymousFunctions'],
            $count['functions'] > 0 ? ($count['anonymousFunctions'] / $count['functions']) * 100 : 0,
            $count['constants'],
            $count['globalConstants'],
            $count['constants'] > 0 ? ($count['globalConstants'] / $count['constants']) * 100 : 0,
            $count['classConstants'],
            $count['constants'] > 0 ? ($count['classConstants'] / $count['constants']) * 100 : 0
        );
        return $str;
    }
}
