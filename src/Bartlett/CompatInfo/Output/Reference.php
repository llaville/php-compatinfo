<?php

namespace Bartlett\CompatInfo\Output;

use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableSeparator;

/**
 * Reference results
 *
 */
class Reference extends OutputFormatter
{
    /**
     *
     *
     * @param OutputInterface $output
     * @param array           $response
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
