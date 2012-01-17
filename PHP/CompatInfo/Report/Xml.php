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
 * @version  SVN: $Id$
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

        $indentStep = 4;
        $indent     = $indentStep;

        echo str_repeat(' ', $indent);
        echo '<files>' . PHP_EOL;
        $indent += $indentStep;

        foreach ($report as $filename => $elements) {

            echo str_repeat(' ', $indent);
            echo '<file name="' . $filename . '">' . PHP_EOL;

            // PHP required versions
            $indent += $indentStep;
            echo str_repeat(' ', $indent);
            echo '<versions>' . PHP_EOL;
            $indent += $indentStep;
            echo str_repeat(' ', $indent);
            echo '<min>' . $elements['versions'][0] . '</min>' . PHP_EOL;
            if (!empty($elements['versions'][1])) {
                echo str_repeat(' ', $indent);
                echo '<max>' . $elements['versions'][1] . '</max>' . PHP_EOL;
            }
            $indent -= $indentStep;
            echo str_repeat(' ', $indent);
            echo '</versions>' . PHP_EOL;
            $indent -= $indentStep;

            $this->updateVersion(
                $elements['versions'][0], $globalVersions[0]
            );
            $this->updateVersion(
                $elements['versions'][1], $globalVersions[1]
            );

            // all conditions found in $filename
            $ccn = $this->getCCN($elements['conditions']);
            if ($ccn > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<conditions>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['conditions'] as $condition => $count) {
                    if ($count > 0) {
                        echo str_repeat(' ', $indent);
                        echo '<condition name="' . $condition .
                            '" count="' . $count . '" />' . PHP_EOL;
                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</conditions>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all extensions found in $filename
            if (count($elements['extensions']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<extensions>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['extensions'] as $extension => $data) {
                    echo str_repeat(' ', $indent);
                    echo '<extension name="' . $extension . '" />' . PHP_EOL;
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</extensions>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all traits found in $filename
            if (count($elements['traits']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<traits>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['traits'] as $category => $items) {
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    foreach ($items as $trait => $data) {
                        echo str_repeat(' ', $indent);
                        echo '<trait name="' . $trait .
                            '" extension="' . $extension .
                            '" count="' . $data['uses'] .
                            '" />' . PHP_EOL;
                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</traits>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all interfaces found in $filename
            if (count($elements['interfaces']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<interfaces>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['interfaces'] as $category => $items) {
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    foreach ($items as $interface => $data) {
                        echo str_repeat(' ', $indent);
                        echo '<interface name="' . $interface .
                            '" extension="' . $extension .
                            '" count="' . $data['uses'] .
                            '" />' . PHP_EOL;
                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</interfaces>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all classes found in $filename
            if (count($elements['classes']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<classes>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['classes'] as $category => $items) {
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    foreach ($items as $class => $data) {
                        echo str_repeat(' ', $indent);
                        echo '<class name="' . $class .
                            '" extension="' . $extension .
                            '" count="' . $data['uses'] .
                            '" />' . PHP_EOL;
                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</classes>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all functions found in $filename
            if (count($elements['functions']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<functions>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['functions'] as $category => $items) {
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    foreach ($items as $function => $data) {
                        echo str_repeat(' ', $indent);
                        echo '<function name="' . $function .
                            '" extension="' . $extension .
                            '" count="' . $data['uses'] .
                            '" />' . PHP_EOL;

                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</functions>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all constants found in $filename
            if (count($elements['constants']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<constants>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['constants'] as $category => $items) {
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    foreach ($items as $constant => $data) {
                        echo str_repeat(' ', $indent);
                        echo '<constant name="' . $constant .
                            '" extension="' . $extension .
                            '" count="' . $data['uses'] .
                            '" />' . PHP_EOL;
                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</constants>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all globals found in $filename
            if (count($elements['globals']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<globals>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['globals'] as $category => $items) {
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    foreach ($items as $constant => $data) {
                        echo str_repeat(' ', $indent);
                        echo '<global name="' . $constant .
                            '" scope="' . $extension .
                            '" count="' . $data['uses'] .
                            '" />' . PHP_EOL;
                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</globals>' . PHP_EOL;
                $indent -= $indentStep;
            }

            // all tokens found in $filename
            if (count($elements['tokens']) > 0) {
                $indent += $indentStep;
                echo str_repeat(' ', $indent);
                echo '<tokens>' . PHP_EOL;
                $indent += $indentStep;
                foreach ($elements['tokens'] as $category => $items) {
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    foreach ($items as $constant => $data) {
                        echo str_repeat(' ', $indent);
                        echo '<token name="' . $constant .
                            '" extension="' . $extension .
                            '" count="' . $data['uses'] .
                            '" />' . PHP_EOL;
                    }
                }
                $indent -= $indentStep;
                echo str_repeat(' ', $indent);
                echo '</tokens>' . PHP_EOL;
                $indent -= $indentStep;
            }

            echo str_repeat(' ', $indent);
            echo '</file>'.PHP_EOL;
        }

        $indent -= $indentStep;
        echo str_repeat(' ', $indent);
        echo '</files>' . PHP_EOL;

        echo str_repeat(' ', $indent);
        echo '<versions>' . PHP_EOL;
        $indent += $indentStep;
        echo str_repeat(' ', $indent);
        echo '<min>' . $globalVersions[0] . '</min>' . PHP_EOL;
        if (!empty($globalVersions[1])) {
            echo str_repeat(' ', $indent);
            echo '<max>' . $globalVersions[1] . '</max>' . PHP_EOL;
        }
        $indent -= $indentStep;
        echo str_repeat(' ', $indent);
        echo '</versions>' . PHP_EOL;

        echo '</phpcompatinfo>' . PHP_EOL;
    }
}
