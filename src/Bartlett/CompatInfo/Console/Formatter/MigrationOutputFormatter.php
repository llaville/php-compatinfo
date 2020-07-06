<?php declare(strict_types=1);

/**
 * Migration Analyser formatter class for console output.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Console\Formatter;

use Bartlett\CompatInfo\Sniffs\PHP\Metrics;

use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Migration Analyser formatter class for console output.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.0.0
 */
class MigrationOutputFormatter extends OutputFormatter
{
    protected $labels = array(
        Metrics::ARRAY_DEREFERENCING_SYNTAX     => 'Array Dereferencing Syntax',
        Metrics::SHORT_OPEN_TAG                 => 'Short Open Tag',
        Metrics::SHORT_ARRAY_SYNTAX             => 'Short Array Syntax',
        Metrics::COMBINED_COMPARISON_OPERATOR   => 'Combined Comparison (Spaceship) Operator',
        Metrics::CONST_SYNTAX_1                 => 'Use of CONST keyword outside of a class',
        Metrics::CONST_SYNTAX_2                 => 'Constant Scalar Expressions',
        Metrics::DEPRECATED_ASSIGN_REFS         => 'Assignment by reference for object construction',
        Metrics::DOC_STRING_SYNTAX_1            => 'Use of nowdoc syntax',
        Metrics::DOC_STRING_SYNTAX_2            => 'Use of heredoc syntax',
        Metrics::DOC_STRING_SYNTAX_3            => 'Use of heredoc syntax in class properties',
        Metrics::RETURN_TYPE_DECLARATION        => 'Return Type Declaration Syntax',
        Metrics::USE_CONST_FUNCTION             => 'Use const or use function syntax',
        Metrics::ANONYMOUS_FUNCTION_1           => 'Use of $this inside a closure',
        Metrics::ANONYMOUS_FUNCTION_2           => 'Use of %s inside a closure',
        Metrics::ANONYMOUS_FUNCTION_3           => 'Anonymous function',
        Metrics::VARIADIC_FUNCTION              => 'Variadic function',
        Metrics::SHORT_TERNARY_OPERATOR_SYNTAX  => 'Short Ternary Operator Syntax',
    );

    protected $warningCount;
    protected $errorCount;

    /**
     * Migration Analyser console output format
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Analyser Metrics
     *
     * @return void
     */
    public function __invoke(OutputInterface $output, array $response): void
    {
        $this->printHeader($output);

        // prints details of each elements found
        $this->printBody($output, $response);

        $this->printFooter($output);
    }

    /**
     * Prints header of report
     *
     * @param OutputInterface $output Console Output concrete instance
     *
     * @return void
     */
    protected function printHeader(OutputInterface $output): void
    {
        $output->writeln(
            sprintf('%s<info>Migration Analysis</info>%s', PHP_EOL, PHP_EOL)
        );
    }

    /**
     * Prints footer of report
     *
     * @param OutputInterface $output Console Output concrete instance
     *
     * @return void
     */
    protected function printFooter(OutputInterface $output): void
    {
        $output->writeln(
            sprintf(
                '%s<php>Found %d warning(s), %d error(s)</php>',
                PHP_EOL,
                $this->warningCount,
                $this->errorCount
            )
        );
    }

    /**
     * Prints details of report
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Analyser Metrics
     *
     * @return void
     */
    protected function printBody(OutputInterface $output, array $response): void
    {
        $genericTemplate = '%s%s is <%s>%s</%s> since <info>%s</info>';

        $templates = array(
            Metrics::DEPRECATED_FUNCTIONS
                => '%sFunction <info>%s()</info> is <%s>%s</%s> since <info>%s</info>',
            Metrics::DEPRECATED_DIRECTIVES
                => '%sIni Entry <info>%s</info> is <%s>%s</%s> since <info>%s</info>',
            Metrics::MAGIC_METHODS
                => '%sMagic Method <info>%s()</info> is <%s>%s</%s> since <info>%s</info>',
        );

        $this->warningCount = $this->errorCount = 0;

        foreach ($response as $group => $elements) {
            foreach ($elements as $element => $values) {
                $status  = isset($values['severity']) ? $values['severity'] : 'warning';
                $message = isset($values['message'])  ? $values['message']  : null;

                if ('warning' == $status) {
                    $this->warningCount++;
                } elseif ('error' == $status) {
                    $this->errorCount++;
                }

                if (Metrics::KEYWORD_RESERVED == $group) {
                    $label   = 'reserved';
                    $element = sprintf('Keyword <info>%s</info>', $element);

                } elseif (in_array(
                    $group,
                    array(
                        Metrics::DEPRECATED_FUNCTIONS,
                        Metrics::DEPRECATED_DIRECTIVES,
                        Metrics::DEPRECATED_ASSIGN_REFS
                    )
                )) {
                    $label = 'deprecated';
                    if (Metrics::DEPRECATED_ASSIGN_REFS == $group) {
                        $element = isset($this->labels[$group]) ? $this->labels[$group] : $group;
                    }

                } elseif (in_array(
                    $group,
                    array(
                        Metrics::NO_COMPAT_CALL,
                        Metrics::NO_COMPAT_MAGIC,
                        Metrics::NO_COMPAT_BREAK,
                        Metrics::NO_COMPAT_PARAM,
                        Metrics::NO_COMPAT_REGISTER,
                        Metrics::NO_COMPAT_KEYWORD,
                    )
                )) {
                    $element = $message;
                    if (Metrics::NO_COMPAT_REGISTER == $group) {
                        $label = 'not available';
                    } else {
                        $label = 'available';
                    }

                } elseif (Metrics::REMOVED == $group) {
                    if (null === $message) {
                        $element = sprintf('Function <info>%s()</info>', $element);
                    } else {
                        $element = $message;
                    }
                    $label = 'removed';

                } elseif (Metrics::SHORT_OPEN_TAG == $group) {
                    $label   = 'always available';
                    $element = isset($this->labels[$group]) ? $this->labels[$group] : $group;

                } elseif (Metrics::SHORT_ARRAY_SYNTAX == $group) {
                    $label = 'allowed';

                } elseif (Metrics::CLASS_MEMBER_ACCESS_ON_INSTANTIATION == $group) {
                    $label   = 'allowed';
                    $element = 'Class member access on instantiation syntax';

                } elseif (Metrics::CONST_SYNTAX == $group) {
                    if ('#' == $element) {
                        $grp = Metrics::CONST_SYNTAX_1;
                    } else {
                        $grp = Metrics::CONST_SYNTAX_2;
                    }
                    $element = isset($this->labels[$grp]) ? $this->labels[$grp] : $group;
                    $label   = 'allowed';

                } elseif (Metrics::MAGIC_METHODS == $group) {
                    $label = 'available';

                } elseif (Metrics::INTRODUCED == $group) {
                    if (null === $message) {
                        $element = sprintf('Function <info>%s()</info>', $element);
                    } else {
                        $element = $message;
                    }
                    if (!isset($message) || strpos($message, 'undefined') === false) {
                        $label = 'added';
                    } else {
                        $label = 'removed';
                    }

                } elseif (Metrics::ANONYMOUS_FUNCTION == $group) {
                    if ('this' == $element) {
                        $grp = Metrics::ANONYMOUS_FUNCTION_1;
                        $element = isset($this->labels[$grp]) ? $this->labels[$grp] : $group;
                    } elseif (in_array($element, array('self', 'static'))) {
                        $grp = Metrics::ANONYMOUS_FUNCTION_2;
                        $format  = isset($this->labels[$grp]) ? $this->labels[$grp] : '%s';
                        $element = sprintf($format, $element);
                    } else {
                        $grp = Metrics::ANONYMOUS_FUNCTION_3;
                        $element = isset($this->labels[$grp]) ? $this->labels[$grp] : $group;
                    }
                    $label = 'allowed';


                } elseif (Metrics::USE_CONST_FUNCTION == $group) {
                    $label   = 'allowed';
                    $element = isset($this->labels[$group]) ? $this->labels[$group] : $group;

                } elseif (Metrics::DOC_STRING_SYNTAX == $group) {
                    if ('nowdoc' == $element) {
                        $grp = Metrics::DOC_STRING_SYNTAX_1;
                    } elseif ('heredoc' == $element) {
                        $grp = Metrics::DOC_STRING_SYNTAX_2;
                    } else {
                        $grp = Metrics::DOC_STRING_SYNTAX_3;
                    }
                    $element = isset($this->labels[$grp]) ? $this->labels[$grp] : $group;
                    $label   = 'allowed';

                } else {
                    $label   = 'allowed';
                    $element = isset($this->labels[$group]) ? $this->labels[$group] : $group;
                }

                $output->writeln(
                    sprintf(
                        isset($templates[$group]) ? $templates[$group] : $genericTemplate,
                        PHP_EOL,
                        $element,
                        $status,
                        $label,
                        $status,
                        $values['version']
                    )
                );
                if ($output->isVerbose()) {
                    // prints each use location
                    $output->writeln(str_repeat('-', 79));
                    foreach ($values['spots'] as $spot) {
                        $output->writeln(
                            sprintf(
                                "%5d | %s",
                                $spot['line'],
                                $spot['file']
                            )
                        );
                    }
                    $output->writeln(str_repeat('-', 79));
                }
            }
        }
    }
}
