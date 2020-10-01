<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo;

use Bartlett\CompatInfo\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Client;

/**
 * Common Class TestCase
 *
 * @link https://phpunit.readthedocs.io/en/9.3/writing-tests-for-phpunit.html
 * @since 5.4.0
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected static $fixtures;
    protected static $analyserId;
    protected static $api;
    protected static $sniffs;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$fixtures = __DIR__ . DIRECTORY_SEPARATOR
            . 'fixtures' . DIRECTORY_SEPARATOR
        ;

        self::$analyserId = CompatibilityAnalyser::class;

        $client = new Client();

        // request for a Bartlett\CompatInfo\Api\Analyser
        self::$api = $client->api('analyser');
    }

    /**
     * Execute a single test case and return metrics
     *
     * @param string $dataSource
     * @return array
     */
    protected function executeAnalysis(string $dataSource): array
    {
        $profile = self::$api->run(self::$fixtures . $dataSource, false, self::$sniffs);

        $data = $profile->getData();
        $token = key($data);

        return $data[$token];
    }
}
