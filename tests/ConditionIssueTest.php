<?php
/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 4.0.0-alpha2+1
 */

namespace Bartlett\Tests\CompatInfo;

/**
 * @link https://github.com/llaville/php-compat-info/issues/128
 * @link https://github.com/llaville/php-compat-info/issues/159
 * @link https://github.com/llaville/php-compat-info/issues/160
 * @link https://github.com/llaville/php-compat-info/issues/195
 */
final class ConditionIssueTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'conditions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #128
     *
     * @link https://github.com/llaville/php-compat-info/issues/128
     *       Detection of conditional code
     * @link https://www.php.net/manual/en/function.idn-to-ascii.php
     * @group regression
     * @return void
     */
    public function testRegressionGH128()
    {
        $dataSource = 'gh128.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '4.0.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #159
     *
     * @link https://github.com/llaville/php-compat-info/issues/159
     *       Conditionally used class is reported as required
     * @group regression
     * @return void
     */
    public function testRegressionGH159()
    {
        $dataSource = 'gh159.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            '4.3.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );

        $this->assertArrayHasKey('Normalizer', $classes);

        $this->assertEquals(
            '5.3.0alpha1',
            $classes['Normalizer']['php.min']
        );
        $this->assertEquals(
            '',
            $classes['Normalizer']['php.max']
        );
        $this->assertEquals(
            'intl',
            $classes['Normalizer']['ext.name']
        );
        $this->assertEquals(
            '1.0.0beta',
            $classes['Normalizer']['ext.min']
        );
        $this->assertEquals(
            '',
            $classes['Normalizer']['ext.max']
        );
    }

    /**
     * Regression test for issue #160
     *
     * @link https://github.com/llaville/php-compat-info/issues/160
     *       Depending on parsing file order, some code conditions are not detected
     * @group regression
     * @return void
     */
    public function testRegressionGH160()
    {
        $dataSource = 'gh160';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '4.0.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #195
     *
     * @link https://github.com/llaville/php-compat-info/issues/195
     *       Absolutely namespaced classes not properly detected with class_exists()
     * @group regression
     * @return void
     */
    public function testRegressionGH195()
    {
        $dataSource = 'gh195.php';
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

        $this->assertArrayHasKey('Normalizer\normalize', $methods);

        $this->assertEquals(
            '5.3.0alpha1',
            $methods['Normalizer\normalize']['php.min']
        );
        $this->assertEquals(
            '',
            $methods['Normalizer\normalize']['php.max']
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
    }
}
