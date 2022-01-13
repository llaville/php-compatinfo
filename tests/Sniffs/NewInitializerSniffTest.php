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
 * New in initializers (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/migration81.new-features.php#migration81.new-features.core.new-in-initializer
 * @link https://wiki.php.net/rfc/new_in_initializers
 * @link https://stitcher.io/blog/php-81-new-in-initializers
 * @see tests/Sniffs/ParamValueDeclarationSniffTest.php
 */
final class NewInitializerSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'classes' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Provider to test new in initializers
     *
     * @return iterable
     */
    public function initializersProvider(): iterable
    {
        $provides = [
            'constant_initializers.php' => [
                'php.min' => '8.1.0beta1',
            ],
            'function_initializers.php' => [
                'php.min' => '8.1.0beta1',
            ],
            'method_initializers.php' => [
                'php.min' => '8.1.0beta1',
            ],
            'static_initializers.php' => [
                'php.min' => '8.1.0beta1',
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Feature test for new in initializers
     *
     * @link https://github.com/llaville/php-compatinfo/issues/325
     *       New in Initializers is detected as PHP 8.1
     * @group features
     * @dataProvider initializersProvider
     * @return void
     * @throws Exception
     */
    public function testNewInitializerBy(string $dataSource, array $expectedVersions)
    {
        $metrics  = $this->executeAnalysis($dataSource);
        $versions = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }
}
