<?php

$baseDir   = dirname(__DIR__);
$vendorDir = $baseDir . '/vendor';

$loader = require_once $vendorDir . '/autoload.php';
$loader->addClassMap(
    array(
        'Bartlett\LoggerTestListener'
            =>  __DIR__ . '/../vendor/bartlett/phpunit-loggertestlistener/src/Bartlett/LoggerTestListener.php',
        'Monolog\Handler\GrowlHandler'
            =>  __DIR__ . '/../vendor/bartlett/phpunit-loggertestlistener/extra/GrowlHandler.php',
        'Monolog\Handler\AdvancedFilterHandler'
            =>  __DIR__ . '/../vendor/bartlett/phpunit-loggertestlistener/extra/AdvancedFilterHandler.php',
    )
);

require __DIR__ . '/Reference/GenericTest.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\GrowlHandler;
use Monolog\Handler\AdvancedFilterHandler;

class Psr3Logger extends Logger
{
    public function __construct($name = 'PHPUnit')
    {
        // filter to be notified only on end test suite.
        $filter1 = function($record) {
            return (preg_match('/^TestSuite(.*)ended\. Tests/', $record['message']) === 1);
        };

        $stream = new StreamHandler('/var/logs/phpcompatinfo.log');
        $growl  = new GrowlHandler(array(), Logger::NOTICE);

        $filterGrowl = new AdvancedFilterHandler(
            $growl,
            array($filter1)
        );

        parent::__construct($name, array($stream, $filterGrowl));
    }
}
