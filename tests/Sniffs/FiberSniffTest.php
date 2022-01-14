<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

use Exception;

/**
 * Fibers since PHP 8.1
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/language.fibers.php
 * @link https://wiki.php.net/rfc/fibers
 * @link https://php.watch/versions/8.1/fibers
 */
final class FiberSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'fibers' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Provider to test Fibers syntax
     *
     * @return iterable
     */
    public function fibersProvider(): iterable
    {
        $provides = [
            'fiber_class.php' => [
                'php.min' => '4.0.0',
            ],
            'fiber_example_echo.php' => [
                'php.min' => '8.1.0alpha1',
            ],
            'fiber_example_file_copy.php' => [
                'php.min' => '8.1.0alpha1',
            ]
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Feature test for Fibers
     *
     * @link https://github.com/llaville/php-compatinfo/issues/330
     *       Fibers are detected as PHP 8.1
     * @group group
     * @dataProvider fibersProvider
     * @return void
     * @throws Exception
     */
    public function testFiberClasses(string $dataSource, array $expectedVersions)
    {
        $metrics  = $this->executeAnalysis($dataSource);
        $versions = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }
}
