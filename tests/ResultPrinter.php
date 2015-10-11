<?php
/**
 * Prints the result of a TestRunner run using a PSR-3 logger.
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 4.2.0
 */

namespace Bartlett\Tests\CompatInfo;

use Bartlett\LoggerTestListenerTrait;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\LogLevel;

/**
 * Prints the result of a TestRunner run using a PSR-3 logger.
 *
 * Use with `--printer` switch on command line
 * or `printerClass` attribute in phpunit.xml config file.
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class ResultPrinter extends \PHPUnit_TextUI_ResultPrinter
{
    use LoggerTestListenerTrait, LoggerAwareTrait;

    /**
     * {@inheritDoc}
     */
    public function __construct($out = null, $verbose = false, $colors = self::COLOR_DEFAULT, $debug = false, $numberOfColumns = 80)
    {
        parent::__construct($out, $verbose, $colors, $debug, $numberOfColumns);

        if ($this->debug) {
            $minLevelOrList = LogLevel::INFO;
        } elseif ($this->verbose) {
            $minLevelOrList = LogLevel::NOTICE;
        } else {
            $minLevelOrList = array(LogLevel::NOTICE, LogLevel::ERROR);
        }

        $console = new \MonologConsoleLogger('ResultPrinter');
        $console->setAcceptedLevels($minLevelOrList);

        $handlers = $console->getHandlers();
        foreach ($handlers as &$handler) {
            // attachs processors only to console handler
            if ($handler instanceof \Monolog\Handler\FilterHandler) {
                // new results presentation when color is supported or not
                $handler->pushProcessor(array($this, 'messageProcessor'));

                // reformat test suite names for references only
                $handler->pushProcessor(array($this, 'suiteNameProcessor'));
            }
        }
        $this->setLogger($console);
    }

    /**
     * {@inheritDoc}
     */
    public function printResult(\PHPUnit_Framework_TestResult $result)
    {
        $this->printHeader();
        $this->printFooter($result);
    }

    protected function printHeader()
    {
        $stats  = $this->getStats();
        $suites = array_keys($stats);

        $numReferences = 0;

        foreach ($suites as $suiteName) {
            if (strpos($suiteName, '::') !== false) {
                continue;
            }
            $parts = explode("\\", $suiteName);
            if (substr(array_pop($parts), -13) == 'ExtensionTest') {
                $numReferences++;
            }
        }

        $this->logger->notice(
            \PHP_Timer::resourceUsage() .
            "\n",
            array('operation' => __FUNCTION__)
        );
    }

    public function messageProcessor(array $record)
    {
        $self  = $this;
        $debug = $this->debug;

        $context = $record['context'];

        if (!array_key_exists('operation', $context)) {
            return $record;
        }

        if ('printHeader' == $context['operation']) {
            $color  = 'fg-yellow';
            $record['message'] = $self->formatWithColor($color, $record['message']);

        } elseif ('printFooter' == $context['operation']) {
            if ($context['testCount'] === 0) {
                $color = 'fg-black, bg-yellow';
            } else {
                $color = ($context['status'] == 'OK')
                    ? 'fg-black, bg-green' : 'fg-white, bg-red';
            }
            $record['message'] = $self->formatWithColor($color, $record['message']);

        } elseif ('startTestSuite' == $context['operation']) {
            $record['message'] =
                $self->formatWithColor('fg-yellow', $context['suiteName'].':') .
                "\n\n    " .
                $self->formatWithColor(
                    'fg-cyan',
                    sprintf('Test suite started with %d tests', $context['testCount'])
                ) .
                "\n"
            ;

        } elseif ('endTestSuite' == $context['operation']) {
            $resultStatus  = ($context['errorCount'] + $context['failureCount']) ? 'KO' : 'OK';
            $resultMessage = sprintf('Results %s. ', $resultStatus) .
                $self->formatCounters(
                    $context['testCount'],
                    $context['assertionCount'],
                    $context['failureCount'],
                    $context['errorCount'],
                    $context['incompleteCount'],
                    $context['skipCount'],
                    $context['riskyCount']
                )
            ;
            if ($resultStatus == 'OK') {
                if ($context['testCount'] === 0) {
                    $color = 'fg-black, bg-yellow';
                } else {
                    $color = 'fg-yellow';
                }
            } else {
                $color = 'fg-red';
            }

            $record['message'] =
                $self->formatWithColor('fg-yellow', $context['suiteName'].':') .
                "\n\n    " .
                $self->formatWithColor(
                    'fg-cyan',
                    'Test suite ended. '
                ) .
                $self->formatWithColor(
                    $color,
                    $resultMessage
                ) .
                "\n"
            ;

        } elseif (in_array(strtolower($record['level_name']), array(LogLevel::INFO, LogLevel::WARNING, LogLevel::ERROR))) {
            // indent messages
            $indent = str_repeat(' ', 4);

            $shortLabel = $context['testName'];
            $longLabel  = str_replace($context['testDescriptionArr'][0].'::', '', $context['testDescriptionStr']);

            if ('startTest' == $context['operation']) {
                $record['message'] = sprintf("%sTest '%s' started.", $indent, ($debug ? $longLabel : $shortLabel));
            }
            elseif ('endTest' == $context['operation']) {
                $record['message'] = sprintf("%sTest '%s' ended.", $indent, $shortLabel);
            }
            elseif ('addError' == $context['operation']) {
                $record['message'] = sprintf("%sError while running test '%s'. %s", $indent, $shortLabel, $context['reason']);
            }
            elseif ('addFailure' == $context['operation']) {
                $record['message'] = sprintf("%sTest '%s' failed. %s", $indent, $shortLabel, $context['reason']);
            }
            elseif ('addIncompleteTest' == $context['operation']) {
                $record['message'] = sprintf("%sTest '%s' is incomplete. %s", $indent, $shortLabel, $context['reason']);
            }
            elseif ('addRiskyTest' == $context['operation']) {
                $record['message'] = sprintf("%sTest '%s' is risky. %s", $indent, $shortLabel, $context['reason']);
            }
            elseif ('addSkippedTest' == $context['operation']) {
                $record['message'] = sprintf("%sTest '%s' has been skipped. %s", $indent, $shortLabel, $context['reason']);
            }
        }

        return $record;
    }

    public function suiteNameProcessor(array $record)
    {
        $context = $record['context'];

        if (!array_key_exists('operation', $context)) {
            return $record;
        }

        if (in_array($context['operation'], array('startTestSuite', 'endTestSuite'))) {
            $suiteName = $context['suiteName'];

            if (strpos($suiteName, 'ExtensionTest::') > 0) {
                $suiteName = str_replace(
                    array(__NAMESPACE__ . '\Reference\Extension\\', 'ExtensionTest::'),
                    array('', ' > '),
                    $suiteName
                );
            }
            $record['context']['suiteName'] = $suiteName;
        }

        return $record;
    }
}
