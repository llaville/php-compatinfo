<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests;

use Exception;
use function array_diff;
use function array_filter;
use function array_keys;
use function version_compare;

/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * @author Laurent Laville
 * @author Remi Collet
 * @since  Class available since Release 4.0.0-alpha2+1
 *
 * @link https://github.com/llaville/php-compat-info/issues/128
 * @link https://github.com/llaville/php-compat-info/issues/159
 * @link https://github.com/llaville/php-compat-info/issues/160
 * @link https://github.com/llaville/php-compat-info/issues/195
 * @link https://github.com/llaville/php-compat-info/issues/301
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
     * @throws Exception
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
     * @throws Exception
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
     * @throws Exception
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
     * @throws Exception
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

    /**
     * Regression test for issue #301
     *
     * @link https://github.com/llaville/php-compat-info/issues/301
     *       Multiple conditions not displayed
     * @group regression
     * @return void
     * @throws Exception
     */
    public function testRegressionGH301()
    {
        $dataSource = 'gh301';
        $metrics = $this->executeAnalysis($dataSource);

        $functions = $metrics[self::$analyserId]['functions'];
        $functions = array_filter($functions, function($function) {
            return ($function['optional'] ?? false) && version_compare($function['ext.min'], '8.0.0alpha1', 'eq');
        });
        $diff = array_diff(
            array_keys($functions),
            [
                'fdiv',
                'preg_last_error_msg',
                'str_contains',
                'str_starts_with',
                'str_ends_with',
                'get_debug_type',
                'get_resource_id',
            ]
        );
        $this->assertCount(0, $diff, 'Conditional functions analysis does not match');

        $constants = $metrics[self::$analyserId]['constants'];
        $constants = array_filter($constants, function($constant) {
            return ($constant['optional'] ?? false) && version_compare($constant['ext.min'], '8.0.0alpha1', 'eq');
        });
        $diff = array_diff(
            array_keys($constants),
            [
                'FILTER_VALIDATE_BOOL',
            ]
        );
        $this->assertCount(0, $diff, 'Conditional constants analysis does not match');
    }
}
