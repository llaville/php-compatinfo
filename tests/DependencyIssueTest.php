<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests;

/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * @author Laurent Laville
 * @author Remi Collet
 * @since  Class available since Release 4.0.0-alpha2+1
 *
 * @link https://github.com/llaville/php-compat-info/issues/100
 * @link https://github.com/llaville/php-compat-info/issues/165
 * @link https://github.com/llaville/php-compat-info/issues/194
 */
final class DependencyIssueTest extends TestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'features' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #100
     *
     * @link https://github.com/llaville/php-compat-info/issues/100
     *       Reports "5.2.0 (min)" on DateTime::diff (which requires 5.3)
     * @group regression
     */
    public function testRegressionGH100(): void
    {
        $dataSource = 'gh100.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '5.3.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );

        $this->assertEquals(
            '5.3.0',
            $methods['DateTime\diff']['php.min']
        );
    }

    /**
     * Feature test for request #165
     *
     * @link https://github.com/llaville/php-compat-info/issues/165
     *       Find undeclared elements
     * @group features
     */
    public function testFeatureGH165(): void
    {
        $dataSource = 'gh165.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];

        $undeclaredClasses = [
            'Console_Table',
            'Doctrine\Common\Cache\Cache',
            'Foo\Foo',
            'SebastianBergmann\Version',
        ];

        foreach ($undeclaredClasses as $c) {
            $this->assertFalse(
                $classes[$c]['declared'],
                "$c is marked as declared while declaration is not expected"
            );
        }
    }

    /**
     * Regression test for issue #194
     *
     * @link https://github.com/llaville/php-compat-info/issues/194
     *       Static method calls don't properly adjust total requirements
     * @group regression
     */
    public function testRegressionGH194(): void
    {
        $dataSource = 'gh194.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '5.3.0alpha1',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );

        $this->assertEquals(
            'intl',
            $methods['Normalizer\normalize']['ext.name']
        );
        $this->assertEquals(
            '1.0.0beta',
            $methods['Normalizer\normalize']['ext.min']
        );
        $this->assertEquals(
            '',
            $methods['Normalizer\normalize']['ext.max']
        );
        $this->assertEquals(
            '5.3.0alpha1',
            $methods['Normalizer\normalize']['php.min']
        );
        $this->assertEquals(
            '',
            $methods['Normalizer\normalize']['php.max']
        );
    }
}
