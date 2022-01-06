<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\PhpParser\NodeVisitor;

/**
 * NodeVisitor Resolver to initialize base php.min version
 * of namespaces, classes, interfaces, traits and functions declaration
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/131
 * @link https://github.com/llaville/php-compat-info/issues/166
 */
final class VersionResolverVisitorTest extends NodeVisitorTestCase
{
    /**
     * Regression test for issue #131
     *
     * @link https://github.com/llaville/php-compat-info/issues/131
     *       "Classes in extends clause are not recognized"
     * @group regression
     * @return void
     */
    public function testRegressionGH131()
    {
        $dataSource = 'gh131.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.1.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #166
     *
     * @link https://github.com/llaville/php-compat-info/issues/166
     *       "Type hinting and objects"
     * @group regression
     * @return void
     */
    public function testRegressionGH166()
    {
        $dataSource = 'gh166.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];
        $interfaces = $metrics[self::$analyserId]['interfaces'];

        $this->assertEquals(
            'spl',
            $interfaces['RecursiveIterator']['ext.name']
        );
        $this->assertEquals(
            '5.1.0',
            $interfaces['RecursiveIterator']['php.min']
        );
        $this->assertEquals(
            '',
            $interfaces['RecursiveIterator']['php.max']
        );

        $this->assertEquals(
            'spl',
            $classes['Foo']['ext.name']
        );
        $this->assertEquals(
            '5.1.0',
            $classes['Foo']['php.min']
        );
        $this->assertEquals(
            '',
            $classes['Foo']['php.max']
        );
    }
}
