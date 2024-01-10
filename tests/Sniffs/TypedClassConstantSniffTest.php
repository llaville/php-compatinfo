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
 * Typed Class constants
 *
 * @author Laurent Laville
 * @since  Class available since Release 7.1.0
 *
 * @link https://wiki.php.net/rfc/typed_class_constants
 * @link https://php.watch/versions/8.3/typed-constants
 * @link https://stitcher.io/blog/new-in-php-83#typed-class-constants-rfc
 */
class TypedClassConstantSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'constants' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Provider to test Typed Class Constants
     */
    public static function  typedConstantsProvider(): iterable
    {
        $provides = [
            'typed_const.php' => [
                'Test\FOO' => [
                    'php.min' => '8.3.0alpha1',
                ],
                'Test\GARPLY' => [
                    'php.min' => '8.3.0alpha1',
                ],
                'Test\WALDO' => [
                    'php.min' => '8.3.0alpha1',
                ],
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Feature test for typed class constants
     *
     * @link https://github.com/llaville/php-compatinfo/issues/366
     *       Typed class constants are detected as PHP 8.3
     * @link https://github.com/php/php-src/commit/414f71a90254cc33896bb3ba953f979f743c198c
     * @group features
     * @dataProvider typedConstantsProvider
     * @throws Exception
     */
    public function testTypedClassConstants(string $dataSource, array $expectedVersions): void
    {
        $metrics    = $this->executeAnalysis($dataSource);
        $constants  = $metrics[self::$analyserId]['constants'];

        foreach ($expectedVersions as $name => $versions) {
            $this->assertArrayHasKey($name, $constants);
            foreach ($versions as $key => $value) {
                $this->assertEquals($value, $constants[$name][$key]);
            }
        }
    }
}
