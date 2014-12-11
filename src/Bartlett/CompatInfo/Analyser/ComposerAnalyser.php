<?php
/**
 * The CompatInfo Composer analyser accessible through the AnalyserPlugin.
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
 * This analyzer collects versions on all extensions of a project for Composer.
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
    const JSON_PRETTY_PRINT = 128;

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

        $eaExtensionsStr = Metrics::EXTENSION_ANALYSER . '.' . Metrics::EXTENSIONS;
        $eaVersionsStr   = Metrics::EXTENSION_ANALYSER . '.' . Metrics::VERSIONS;

        if (!is_array($this->count[$eaExtensionsStr]) || count($this->count[$eaExtensionsStr]) == 0) {
            $output->writeln(json_encode($extensions));
        }

        // include PHP version
        $extensions['php'] = '>= ' . $this->count[$eaVersionsStr]['php.min'];

        // include extensions
        foreach ($this->count[$eaExtensionsStr] as $key => $val) {
            if (in_array($key, array('standard', 'Core'))) {
                continue;
            }
            $extensions['ext-' . $key] = '*';
        }

        // wrap
        $extensions = array('require' => $extensions);
        $output->writeln(json_encode($extensions, self::JSON_PRETTY_PRINT));
    }

    public function visitPackageModel($package)
    {
        AbstractAnalyser::visitPackageModel($package);
    }
}
