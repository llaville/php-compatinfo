<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests;

use Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Application\Kernel\ConsoleKernel;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;

use Symfony\Component\Console\Input\ArrayInput;

use Exception;
use function reset;
use function sprintf;
use const PHP_MAJOR_VERSION;
use const PHP_MINOR_VERSION;

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
     * @throws Exception
     */
    protected function executeAnalysis(string $dataSource): array
    {
        $compatibilityQuery = new GetCompatibilityQuery(self::$fixtures . $dataSource, [], false, '');

        $environment = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'dev';

        $input = new ArrayInput(['--no-polyfills' => true, '--php' => sprintf('%d.%d', PHP_MAJOR_VERSION, PHP_MINOR_VERSION)]);
        $container = (new ConsoleKernel($environment, true))->createFromInput($input);

        $queryBus = $container->get(QueryBusInterface::class);

        $profile = $queryBus->query($compatibilityQuery);
        $data = $profile->getData();
        return reset($data);
    }
}
