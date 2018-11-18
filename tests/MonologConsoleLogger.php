<?php
/**
 * Prints the result of a TestRunner run using Monolog.
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 4.2.0
 */

namespace Bartlett\Tests\CompatInfo;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FilterHandler;
use Monolog\Formatter\LineFormatter;

use Bartlett\Monolog\Handler\CallbackFilterHandler;
use Bartlett\Monolog\Handler\GrowlHandler;

/**
 * Prints the result of a TestRunner run using Monolog and few handlers.
 *
 * - We log all PHPUnit events to a local file "phpunit-phpcompatinfo.log"
 *   and keep history 30 days
 * - We log some PHPUnit events, depending of --verbose, --debug and --colors switches,
 *   directly to the CLI console
 * - We will notify final results to any Growl client (if available and started)
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class MonologConsoleLogger extends Logger
{
    /**
     * Console logger class constructor
     *
     * @param string $name  The logging channel
     * @param string $level The minimum logging level
     */
    public function __construct($name = 'YourLogger', $level = Logger::DEBUG)
    {
        $filterRules = array(
            function ($record) {
                if (!array_key_exists('operation', $record['context'])) {
                    return false;
                }
                return ('printFooter' === $record['context']['operation']);
            }
        );

        $stream = new RotatingFileHandler(__DIR__ . '/phpunit-phpcompatinfo-php' . PHP_VERSION_ID . '.log', 30);
        $stream->setFilenameFormat('{filename}-{date}', 'Ymd');

        $console = new StreamHandler('php://stdout');
        $console->setFormatter(new LineFormatter("%message%\n", null, true));

        $filter = new FilterHandler($console);

        $handlers = array($filter, $stream);

        if (class_exists('GrowlHandler')
            && class_exists('CallbackFilterHandler')
        ) {
            try {
                $options = array(
                    'resourceDir' => dirname(__DIR__) . '/vendor/pear-pear.php.net/Net_Growl/data/Net_Growl/data',
                    'defaultIcon' => '80/growl_phpunit.png',
                );

                $growl = new GrowlHandler(
                    array(
                        'name'    => 'PHPUnit ResultPrinter',
                        'options' => $options
                    ),
                    Logger::NOTICE
                );
                $growl->setFormatter(
                    new LineFormatter(
                        "PHP CompatInfo\n" .
                        "%message%"
                    )
                );

                $handlers[] = new CallbackFilterHandler(
                    $growl,
                    $filterRules
                );

            } catch (\Exception $e) {
                // Growl server is probably not started
            }
        }

        parent::__construct($name, $handlers);
    }

    /**
     * Returns list of accepted log levels
     *
     * @return array
     */
    public function getAcceptedLevels()
    {
        $handlers = $this->getHandlers();
        foreach ($handlers as &$handler) {
            if ($handler instanceof FilterHandler) {
                return $handler->getAcceptedLevels();
            }
        }
        return array();
    }

    /**
     * Defines log levels that will be accepted.
     *
     * @param int|array $minLevelOrList A list of levels to accept or a minimum level if maxLevel is provided
     * @param int       $maxLevel       Maximum level to accept, only used if $minLevelOrList is not an array
     *
     * @return void
     */
    public function setAcceptedLevels($minLevelOrList = Logger::DEBUG, $maxLevel = Logger::EMERGENCY)
    {
        $handlers = $this->getHandlers();
        foreach ($handlers as &$handler) {
            if ($handler instanceof FilterHandler) {
                $handler->setAcceptedLevels($minLevelOrList, $maxLevel);
                break;
            }
        }
    }
}
