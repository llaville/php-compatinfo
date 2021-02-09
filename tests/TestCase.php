<?php declare(strict_types=1);

/**
 * Common Class TestCase
 *
 * @link https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html
 */

namespace Bartlett\CompatInfo\Tests;

use Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Symfony\Component\Messenger\Exception\HandlerFailedException;

use Exception;
use function reset;

/**
 * @since Release 5.4.0
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected static $fixtures;
    protected static $analyserId;
    protected static $queryBus;
    protected static $sniffs;
    protected static $container;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     * @throws Exception
     */
    public static function setUpBeforeClass(): void
    {
        self::$fixtures = __DIR__ . DIRECTORY_SEPARATOR
            . 'fixtures' . DIRECTORY_SEPARATOR
        ;

        self::$analyserId = CompatibilityAnalyser::class;

        /** @var ContainerBuilder $container */
        self::$container = require dirname(__DIR__) . '/config/container.php';

        self::$queryBus = self::$container->get(QueryBusInterface::class);
    }

    /**
     * Execute a single test case and return metrics
     *
     * @param string $dataSource
     * @return array
     */
    protected function executeAnalysis(string $dataSource): array
    {
        $compatibilityQuery = new GetCompatibilityQuery(self::$fixtures . $dataSource, false);

        try {
            $profile = self::$queryBus->query($compatibilityQuery);
            $data = $profile->getData();
            return reset($data);
        } catch (HandlerFailedException $e) {
            return [];
        }
    }
}
