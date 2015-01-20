<?php
/**
 * Default console output class for Reference Api.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Output;

use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableSeparator;

/**
 * Reference results default render on console
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha3
 */
class Reference extends OutputFormatter
{
    /**
     * Prints the list of references (extensions) supported
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response References list
     *
     * @return void
     */
    public function dir(OutputInterface $output, $response)
    {
        $loaded  = 0;
        $headers = array('Reference', 'Version', 'State', 'Release Date', 'Loaded');

        foreach ($response as $ref) {
            if (empty($ref->loaded) || $ref->outdated) {
                $name = sprintf('<warning>%s</warning>', $ref->name);
            } else {
                $name = $ref->name;
            }
            $rows[] = array(
                $name,
                sprintf('<ext>%s</ext>', $ref->version),
                $ref->state,
                $ref->date,
                sprintf('<php>%s</php>', $ref->loaded),
            );
            if (!empty($ref->loaded)) {
                $loaded++;
            }
        }

        $footers = array(
            '<info>Total</info>',
            sprintf('<info>[%d]</info>', count($response)),
            '',
            '',
            sprintf('<info>[%d]</info>', $loaded)
        );

        $rows[] = new TableSeparator();
        $rows[] = $footers;

        $this->tableHelper($output, $headers, $rows);
    }
}
