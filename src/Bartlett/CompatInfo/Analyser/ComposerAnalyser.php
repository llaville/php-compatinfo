<?php
/**
 * The CompatInfo Extension analyser accessible through the AnalyserPlugin.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\CompatInfo\Metrics;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * This analyzer collects versions on all extensions of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Jens Hassler <j.hassler@iwf.ch>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    2014-12-01
 */
class ComposerAnalyser extends ExtensionAnalyser
{
    /**
     * Renders analyser report to output.
     *
     * @param object OutputInterface $output    Console Output
     *
     * @return void
     */
    public function render(OutputInterface $output)
    {
        $extensions = array();

        if (!is_array($this->count['ea.extensions']) || count($this->count['ea.extensions']) == 0) {
            $output->writeln(json_encode($extensions));
        }

        // include PHP version
        $extensions['php'] = '>= ' . $this->count['ea.versions']['php.min'];

        // include extensions
        foreach ($this->count['ea.extensions'] as $key => $val) {
            $extensions['ext-' . $key] = '*';
        }

        // wrap
        $extensions = array('require' => $extensions);
        $output->writeln(json_encode($extensions, JSON_PRETTY_PRINT));
    }
}
