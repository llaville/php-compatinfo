<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Composer;

use Bartlett\CompatInfo\Application\Extension\Composer\Parser;
use Bartlett\CompatInfo\Tests\TestCase;

/**
 * Unit tests for PHP_CompatInfo package, composer related
 *
 * @author Karsten Deubert
 *
 * @link https://github.com/llaville/php-compatinfo/issues/353
 */
final class ParserTest extends TestCase
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
            'empty.json' => [
                'require' => [],
                'phpversion' => null,
                'extensions' => []
            ],
            'php.json' => [
                'require' => [
                    'php' => '^7.4'
                ],
                'phpversion' => null,
                'extensions' => []
            ],
            'php-extensions.json' => [
                'require' => [
                    'php' => '^7.4',
                    'ext-json' => '*',
                    'ext-libxml' => '*'
                ],
                'phpversion' => null,
                'extensions' => [
                    'json' => '*',
                    'libxml' => '*'
                ]
            ],
            'php-extensions-version.json' => [
                'require' => [
                    'php' => '^7.4 || ^8.0',
                    'ext-json' => '*',
                    'ext-libxml' => '*',
                    'ext-pcre' => '*',
                    'ext-spl' => '*'
                ],
                'phpversion' => '7.4.0',
                'extensions' => [
                    'json' => '*',
                    'libxml' => '*',
                    'pcre' => '*',
                    'spl' => '*'
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
    public function testParser(string $dataSource, array $expectedData)
    {
        $parser = new Parser(self::$fixtures.$dataSource);

        $this->assertEquals($expectedData['require'], $parser->getRequire());
        $this->assertEquals($expectedData['phpversion'], $parser->getPhpVersion());
        $this->assertEquals($expectedData['extensions'], $parser->getExtensions());
    }
}
