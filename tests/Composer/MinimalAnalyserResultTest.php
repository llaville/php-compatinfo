<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Composer;

use Bartlett\CompatInfo\Application\Extension\Composer\MinimalAnalyserResult;
use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Tests\TestCase;

/**
 * Unit tests for PHP_CompatInfo package, composer related
 *
 * @author Karsten Deubert
 *
 * @link https://github.com/llaville/php-compatinfo/issues/353
 */
final class MinimalAnalyserResultTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'composer' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Source Provider
     *
     * @return iterable
     */
    public function dataSourceProvider(): iterable
    {
        $provides = [
            'minimalStaticParserResultEmpty.php' => [
                'versions' => [],
                'extensions' => []
            ],
            'minimalStaticParserResult.php' => [
                'versions' => [
                    'php.min' => '7.4.0',
                    'php.max' => '',
                    'php.all' => '8.0.0alpha1 without symfony/polyfill-php80'
                ],
                'extensions' => [
                    'phar' =>
                        array (
                            'ext.name' => 'phar',
                            'ext.min' => '1.0.0',
                            'ext.max' => NULL,
                            'ext.all' => '',
                            'php.min' => '5.2.0',
                            'php.max' => NULL,
                            'php.all' => '',
                            'matches' => 0,
                            'declared' => false,
                            'rules' =>
                                array (
                                ),
                            'arg.max' => 1,
                            'parents' =>
                                array (
                                    0 =>
                                        array (
                                            'methods' => 'Bartlett\\CompatInfo\\Presentation\\Console\\Application\\run',
                                        ),
                                    1 =>
                                        array (
                                            'classes' => 'Bartlett\\CompatInfo\\Presentation\\Console\\Application',
                                        ),
                                    2 =>
                                        array (
                                            'namespaces' => 'Bartlett\\CompatInfo\\Presentation\\Console',
                                        ),
                                ),
                        ),
                    'spl' =>
                        array (
                            'ext.name' => 'spl',
                            'ext.min' => '5.1.0',
                            'ext.max' => NULL,
                            'ext.all' => '',
                            'php.min' => '5.1.0',
                            'php.max' => NULL,
                            'php.all' => '',
                            'matches' => 0,
                            'declared' => false,
                            'rules' =>
                                array (
                                ),
                            'arg.max' => 1,
                            'parents' =>
                                array (
                                    0 =>
                                        array (
                                            'methods' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer\\Parser\\__construct',
                                        ),
                                    1 =>
                                        array (
                                            'classes' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer\\Parser',
                                        ),
                                    2 =>
                                        array (
                                            'namespaces' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer',
                                        ),
                                ),
                        ),
                    'core' =>
                        array (
                            'ext.name' => 'core',
                            'ext.min' => '7.2.0',
                            'ext.max' => NULL,
                            'ext.all' => '',
                            'php.min' => '5.3.0',
                            'php.max' => NULL,
                            'php.all' => '',
                            'matches' => 0,
                            'declared' => false,
                            'rules' =>
                                array (
                                ),
                            'arg.max' => 0,
                            'parents' =>
                                array (
                                    0 =>
                                        array (
                                            'methods' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer\\MinimalAnalyserResult\\fromProfileFactory',
                                        ),
                                    1 =>
                                        array (
                                            'classes' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer\\MinimalAnalyserResult',
                                        ),
                                    2 =>
                                        array (
                                            'namespaces' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer',
                                        ),
                                ),
                        ),
                    'date' =>
                        array (
                            'ext.name' => 'date',
                            'ext.min' => '5.2.0',
                            'ext.max' => NULL,
                            'ext.all' => '',
                            'php.min' => '5.2.0',
                            'php.max' => NULL,
                            'php.all' => '',
                            'matches' => 0,
                            'declared' => false,
                            'rules' =>
                                array (
                                ),
                            'arg.max' => 0,
                            'parents' =>
                                array (
                                    0 =>
                                        array (
                                            'methods' => 'Bartlett\\CompatInfo\\Application\\Logger\\DefaultLogger\\log',
                                        ),
                                    1 =>
                                        array (
                                            'classes' => 'Bartlett\\CompatInfo\\Application\\Logger\\DefaultLogger',
                                        ),
                                    2 =>
                                        array (
                                            'namespaces' => 'Bartlett\\CompatInfo\\Application\\Logger',
                                        ),
                                ),
                        ),
                    'standard' =>
                        array (
                            'ext.name' => 'standard',
                            'ext.min' => '8.0.0alpha1',
                            'ext.max' => NULL,
                            'ext.all' => '',
                            'php.min' => '7.1.0',
                            'php.max' => NULL,
                            'php.all' => '8.0.0alpha1 without symfony/polyfill-php80',
                            'matches' => 0,
                            'declared' => false,
                            'rules' =>
                                array (
                                ),
                            'parameters' =>
                                array (
                                ),
                            'php.excludes' =>
                                array (
                                ),
                            'polyfill' => NULL,
                            'arg.max' => 2,
                            'parents' =>
                                array (
                                    0 =>
                                        array (
                                            'methods' => 'Bartlett\\CompatInfo\\Presentation\\Console\\FactoryCommandLoader\\__construct',
                                        ),
                                    1 =>
                                        array (
                                            'classes' => 'Bartlett\\CompatInfo\\Presentation\\Console\\FactoryCommandLoader',
                                        ),
                                    2 =>
                                        array (
                                            'namespaces' => 'Bartlett\\CompatInfo\\Presentation\\Console',
                                        ),
                                ),
                        ),
                    'json' =>
                        array (
                            'ext.name' => 'json',
                            'ext.min' => '1.6.0',
                            'ext.max' => NULL,
                            'ext.all' => '',
                            'php.min' => '7.3.0alpha1',
                            'php.max' => NULL,
                            'php.all' => '',
                            'matches' => 0,
                            'declared' => false,
                            'rules' =>
                                array (
                                ),
                            'parameters' =>
                                array (
                                    0 => '5.2.0',
                                    1 => '5.2.0',
                                    2 => '5.3.0',
                                    3 => '5.4.0',
                                ),
                            'php.excludes' =>
                                array (
                                ),
                            'polyfill' => NULL,
                            'arg.max' => 4,
                            'parents' =>
                                array (
                                    0 =>
                                        array (
                                            'methods' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer\\Parser\\__construct',
                                        ),
                                    1 =>
                                        array (
                                            'classes' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer\\Parser',
                                        ),
                                    2 =>
                                        array (
                                            'namespaces' => 'Bartlett\\CompatInfo\\Application\\Extension\\Composer',
                                        ),
                                ),
                        )
                ]
            ]
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * feature test for feature #353
     *
     * @group features
     * @dataProvider dataSourceProvider
     * @return void
     */
    public function testFactory(string $dataSource, array $expectedData)
    {
        $content = include(self::$fixtures.$dataSource);

        $minimalResult = MinimalAnalyserResult::fromProfileFactory($content);

        $this->assertEquals($expectedData['versions'], $minimalResult->getVersions());
        $this->assertEquals($expectedData['extensions'], $minimalResult->getExtensions());
    }
}
