<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Class method declaration
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/129
 */
final class MethodDeclarationSniffTest extends SniffTestCase
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
     * Feature test for PHP 4 syntax class method visibility
     *
     * @group features
     * @return void
     */
    public function testClassMethodVisibilityPHP4Syntax()
    {
        $dataSource = 'php4_public_method_visibility.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '4.0.0',
            $methods['Foo\someThing']['php.min']
        );
        $this->assertEquals(
            '',
            $methods['Foo\someThing']['php.max']
        );
    }

    /**
     * Feature test for PHP 5+ syntax class method visibility
     *
     * @group features
     * @return void
     */
    public function testClassMethodVisibilityPHP5OrGreater()
    {
        $dataSource = 'php5_public_method_visibility.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '5.0.0',
            $methods['Foo\someThing']['php.min']
        );
        $this->assertEquals(
            '',
            $methods['Foo\someThing']['php.max']
        );
    }

    /**
     * Regression test for issue #129
     *
     * @link https://github.com/llaville/php-compat-info/issues/129
     *       "Non-empty classes are reported to require PHP 5.0.0"
     * @group regression
     * @return void
     */
    public function testRegressionGH129()
    {
        $dataSource = 'gh129.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        // implicitly public visibility
        $this->assertEquals(
            '4.0.0',
            $methods['Foo2\bar']['php.min']
        );
        $this->assertEquals(
            '',
            $methods['Foo2\bar']['php.max']
        );

        // explicitly public visibility
        $this->assertEquals(
            '5.0.0',
            $methods['Foo2\baz']['php.min']
        );
        $this->assertEquals(
            '',
            $methods['Foo2\baz']['php.max']
        );
    }
}
