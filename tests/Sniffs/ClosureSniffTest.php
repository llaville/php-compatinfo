<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Closures
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/229
 * @link https://github.com/llaville/php-compat-info/issues/231
 */
final class ClosureSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'functions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #229
     *
     * @link https://github.com/llaville/php-compat-info/issues/229
     *       $this in closures not properly detected
     * @group regression
     * @return void
     */
    public function testRegressionGH229()
    {
        $dataSource = 'gh229.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.4.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #231
     *
     * @link https://github.com/llaville/php-compat-info/issues/231
     *       Closures that work in PHP 5.3 are reported as requiring 5.4
     * @group regression
     * @return void
     */
    public function testRegressionGH231()
    {
        $dataSource = 'gh231.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.3.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Feature test to detect self keyword in a closure
     *
     * @group features
     * @return void
     */
    public function testSelfKeyword()
    {
        $dataSource = 'self_parent_static_closure_oop.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '5.4.0',
            $methods['Foo\testSelf']['php.min']
        );

        $this->assertEquals(
            '',
            $methods['Foo\testSelf']['php.max']
        );
    }

    /**
     * Feature test to detect static keyword in a closure
     *
     * @group features
     * @return void
     */
    public function testStaticKeyword()
    {
        $dataSource = 'self_parent_static_closure_oop.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '5.4.0',
            $methods['Foo\testStatic']['php.min']
        );

        $this->assertEquals(
            '',
            $methods['Foo\testStatic']['php.max']
        );
    }

    /**
     * Feature test to detect parent keyword in a closure
     *
     * @group features
     * @return void
     */
    public function testParentKeyword()
    {
        $dataSource = 'self_parent_static_closure_oop.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '5.4.0',
            $methods['B\fn']['php.min']
        );

        $this->assertEquals(
            '',
            $methods['B\fn']['php.max']
        );
    }

    /**
     * Feature test to detect static closure
     *
     * @group features
     * @return void
     */
    public function testStaticAnonymousFunction()
    {
        $dataSource = 'self_parent_static_closure_oop.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '5.4.0',
            $methods['Foo\staticAnonymousFunction']['php.min']
        );

        $this->assertEquals(
            '',
            $methods['Foo\staticAnonymousFunction']['php.max']
        );
    }
}
