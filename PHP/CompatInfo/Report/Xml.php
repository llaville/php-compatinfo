<?php
/**
 * Xml report
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
 * Xml report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Xml extends PHP_CompatInfo_Report
{
    protected $indentStep;
    protected $ident;
    protected $verbose;

    /**
     * Prints all components (extensions, interfaces, classes, functions,
     * constants), in a proprietary XML format.
     * All components are displayed together, grouped by file
     *
     * @param array  $report  Report data to produce
     * @param string $base    Base directory of data source
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    public function generate($report, $base, $verbose)
    {
        $globalVersions = array('4.0.0', '');

        echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        echo '<phpcompatinfo version="@package_version@"' .
            ' timestamp="' . date(DATE_W3C) . '">'    . PHP_EOL;

        $this->verbose = $verbose;
        $this->indentStep = 4;

        if ($verbose < 3) {
            // PHP required versions
            $this->processVersions($report['versions']);

            // all conditions found in data source
            $ccn = $this->getCCN($report['conditions']);
            if ($ccn > 0) {
                $this->processConditions(
                    $report['conditions'], $report['functions']['Core']
                );
            }

            // all extensions found in data source
            if (count($report['extensions']) > 0) {
                $this->processExtensions($report['extensions']);
            }

            // all namespaces found in data source
            if (count($report['namespaces']) > 0) {
                $this->processNamespaces($report['namespaces']);
            }

            // all traits found in data source
            if (count($report['traits']) > 0) {
                $this->processTraits($report['traits']);
            }

            // all interfaces found in data source
            if (count($report['interfaces']) > 0) {
                $this->processInterfaces($report['interfaces']);
            }

            // all classes found in data source
            if (count($report['classes']) > 0) {
                $this->processClasses($report['classes']);
            }

            // all functions found in data source
            if (count($report['functions']) > 0) {
                $this->processFunctions($report['functions']);
            }

            // all constants found in data source
            if (count($report['constants']) > 0) {
                $this->processConstants($report['constants']);
            }

            // all globals found in data source
            if (count($report['globals']) > 0) {
                $this->processGlobals($report['globals']);
            }

            // all tokens found in data source
            if (count($report['tokens']) > 0) {
                $this->processTokens($report['tokens']);
            }

            echo '</phpcompatinfo>' . PHP_EOL;
            return;
        }

        $this->indent     = $this->indentStep;

        echo str_repeat(' ', $this->indent);
        echo '<files>' . PHP_EOL;
        $this->indent += $this->indentStep;

        foreach ($report as $filename => $elements) {

            echo str_repeat(' ', $this->indent);
            echo '<file name="' . $filename . '">' . PHP_EOL;

            // PHP required versions
            $this->processVersions($elements['versions']);

            $this->updateVersion(
                $elements['versions'][0], $globalVersions[0]
            );
            $this->updateVersion(
                $elements['versions'][1], $globalVersions[1]
            );

            // all conditions found in $filename
            $ccn = $this->getCCN($elements['conditions']);
            if ($ccn > 0) {
                $this->processConditions($elements['conditions']);
            }

            // all extensions found in $filename
            if (count($elements['extensions']) > 0) {
                $this->processExtensions($elements['extensions']);
            }

            // all namespaces found in $filename
            if (count($elements['namespaces']) > 0) {
                $this->processNamespaces($elements['namespaces']);
            }

            // all traits found in $filename
            if (count($elements['traits']) > 0) {
                $this->processTraits($elements['traits']);
            }

            // all interfaces found in $filename
            if (count($elements['interfaces']) > 0) {
                $this->processInterfaces($elements['interfaces']);
            }

            // all classes found in $filename
            if (count($elements['classes']) > 0) {
                $this->processClasses($elements['classes']);
            }

            // all functions found in $filename
            if (count($elements['functions']) > 0) {
                $this->processFunctions($elements['functions']);
            }

            // all constants found in $filename
            if (count($elements['constants']) > 0) {
                $this->processConstants($elements['constants']);
            }

            // all globals found in $filename
            if (count($elements['globals']) > 0) {
                $this->processGlobals($elements['globals']);
            }

            // all tokens found in $filename
            if (count($elements['tokens']) > 0) {
                $this->processTokens($elements['tokens']);
            }

            echo str_repeat(' ', $this->indent);
            echo '</file>'.PHP_EOL;
        }

        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</files>' . PHP_EOL;

        echo str_repeat(' ', $this->indent);
        echo '<versions>' . PHP_EOL;
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<min>' . $globalVersions[0] . '</min>' . PHP_EOL;
        if (!empty($globalVersions[1])) {
            echo str_repeat(' ', $this->indent);
            echo '<max>' . $globalVersions[1] . '</max>' . PHP_EOL;
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</versions>' . PHP_EOL;

        echo '</phpcompatinfo>' . PHP_EOL;
    }

    /**
     * On report where results are grouped by component,
     * show source file list when verbose level is equal to 2
     *
     * @param array $elements Source file list
     *
     * @return void
     */
    private function processFiles($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<files>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $file) {
            echo str_repeat(' ', $this->indent);
            echo '<file name="' . $file . '" />' . PHP_EOL;
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</files>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'versions' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processVersions($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<versions>' . PHP_EOL;
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<min>' . $elements[0] . '</min>' . PHP_EOL;
        if (!empty($elements[1])) {
            echo str_repeat(' ', $this->indent);
            echo '<max>' . $elements[1] . '</max>' . PHP_EOL;
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</versions>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'conditions' elements of global or partial results
     *
     * @param array $elements Items data
     * @param array $extra    (optional) source file list
     *
     * @return void
     */
    private function processConditions($elements, $extra = null)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<conditions>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $condition => $count) {
            if ($count > 0) {
                echo str_repeat(' ', $this->indent);
                echo '<condition name="' . $condition .
                    '" count="' . $count;

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($extra[$condition]['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</condition>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</conditions>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'extensions' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processExtensions($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<extensions>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $extension => $data) {
            echo str_repeat(' ', $this->indent);
            echo '<extension name="' . $extension;

            if ($this->verbose == 2) {
                echo '">' . PHP_EOL;
                $this->processFiles($data['sources']);
                echo str_repeat(' ', $this->indent);
                echo '</extension>' . PHP_EOL;
            } else {
                echo '" />' . PHP_EOL;
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</extensions>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'traits' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processTraits($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<traits>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $trait => $data) {
                if ('\\' !== $data['namespace']) {
                    $trait = $data['namespace'] . '\\' . $trait;
                }
                echo str_repeat(' ', $this->indent);
                echo '<trait name="' . $trait .
                    '" extension="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</trait>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</traits>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'namespaces' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processNamespaces($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<namespaces>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $namespace => $data) {
                echo str_repeat(' ', $this->indent);
                echo '<namespace name="' . $namespace .
                    '" extension="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</namespace>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</namespaces>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'interfaces' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processInterfaces($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<interfaces>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $interface => $data) {
                if ('\\' !== $data['namespace']) {
                    $interface = $data['namespace'] . '\\' . $interface;
                }
                echo str_repeat(' ', $this->indent);
                echo '<interface name="' . $interface .
                    '" extension="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</interface>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</interfaces>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'classes' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processClasses($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<classes>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $class => $data) {
                if ('\\' !== $data['namespace']) {
                    $class = $data['namespace'] . '\\' . $class;
                }
                echo str_repeat(' ', $this->indent);
                echo '<class name="' . $class .
                    '" extension="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</class>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</classes>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'functions' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processFunctions($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<functions>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $function => $data) {
                if ('\\' !== $data['namespace']) {
                    $function = $data['namespace'] . '\\' . $function;
                }
                echo str_repeat(' ', $this->indent);
                echo '<function name="' . $function .
                    '" extension="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</function>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</functions>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'constants' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processConstants($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<constants>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $constant => $data) {
                if ('\\' !== $data['namespace']) {
                    $constant = $data['namespace'] . '\\' . $constant;
                }
                echo str_repeat(' ', $this->indent);
                echo '<constant name="' . $constant .
                    '" extension="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</constant>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</constants>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'globals' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processGlobals($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<globals>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $constant => $data) {
                echo str_repeat(' ', $this->indent);
                echo '<global name="' . $constant .
                    '" scope="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</global>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</globals>' . PHP_EOL;
        $this->indent -= $this->indentStep;
    }

    /**
     * Process 'tokens' elements of global or partial results
     *
     * @param array $elements Items data
     *
     * @return void
     */
    private function processTokens($elements)
    {
        $this->indent += $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '<tokens>' . PHP_EOL;
        $this->indent += $this->indentStep;
        foreach ($elements as $category => $items) {
            if ('user' == $category) {
                $extension = '';
            } else {
                $extension = $category;
            }
            foreach ($items as $constant => $data) {
                echo str_repeat(' ', $this->indent);
                echo '<token name="' . $constant .
                    '" extension="' . $extension .
                    '" count="' . $data['uses'];

                if ($this->verbose == 2) {
                    echo '">' . PHP_EOL;
                    $this->processFiles($data['sources']);
                    echo str_repeat(' ', $this->indent);
                    echo '</token>' . PHP_EOL;
                } else {
                    echo '" />' . PHP_EOL;
                }
            }
        }
        $this->indent -= $this->indentStep;
        echo str_repeat(' ', $this->indent);
        echo '</tokens>' . PHP_EOL;
        $this->indent -= $this->indentStep;

    }

}
