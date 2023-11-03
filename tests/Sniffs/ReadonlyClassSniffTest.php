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
 * Readonly classes syntax (since PHP 8.2)
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://wiki.php.net/rfc/readonly_classes
 * @link https://php.watch/versions/8.2/readonly-classes
 */
final class ReadonlyClassSniffTest extends SniffTestCase
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
     * Data Provider to test Readonly classes syntax
     *
     * @return iterable
     */
    public static function readonlyClassProvider(): iterable
    {
        $provides = [
            'readonly_classes.php' => [
                'MyValueObject' => [
                    'php.min' => '8.2.0alpha1',
                ],
                'Foo' => [
                    'php.min' => '8.2.0alpha1',
                ],
                'Bar' => [
                    'php.min' => '8.2.0alpha1',
                ],
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Feature test for Readonly class syntax
     *
     * @link https://php.watch/versions/8.2/readonly-classes
     *       Readonly Class Syntax is detected as PHP 8.2
     * @group features
     * @dataProvider readonlyClassProvider
     * @return void
     * @throws Exception
     */
    public function testReadonlyClassSyntax(string $dataSource, array $expectedVersions)
    {
        $metrics = $this->executeAnalysis($dataSource);
        $classes = $metrics[self::$analyserId]['classes'];

        foreach ($expectedVersions as $name => $versions) {
            $this->assertArrayHasKey($name, $classes);
            foreach ($versions as $key => $value) {
                $this->assertEquals($value, $classes[$name][$key]);
            }
        }
    }
}
