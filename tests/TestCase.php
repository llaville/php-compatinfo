<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests;

use Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;
use Bartlett\CompatInfo\Infrastructure\Framework\Symfony\DependencyInjection\ContainerFactory;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Exception;
use function reset;

/**
 * Common Class TestCase
 *
 * @author Laurent Laville
 * @since Release 5.4.0, 6.0.0
 * @link https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected static string $fixtures;
    protected static string $analyserId;

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
    }

    /**
     * Execute a single test case and return metrics
     *
     * @param string $dataSource
     * @return array
     * @throws Exception
     */
    protected function executeAnalysis(string $dataSource): array
    {
        $compatibilityQuery = new GetCompatibilityQuery(self::$fixtures . $dataSource, [], false, '');

        /** @var ContainerBuilder $container */
        $container = (new ContainerFactory())->create();
        $queryBus = $container->get(QueryBusInterface::class);

        $profile = $queryBus->query($compatibilityQuery);
        $data = $profile->getData();
        return reset($data);
    }
}
