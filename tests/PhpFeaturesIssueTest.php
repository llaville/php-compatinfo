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
 * @link https://github.com/llaville/php-compat-info/issues/168
 * @link https://github.com/llaville/php-compat-info/issues/213
 * @link https://github.com/llaville/php-compat-info/issues/222
 * @link https://github.com/llaville/php-compat-info/issues/228
 * @link https://github.com/llaville/php-compat-info/issues/239
 * @link https://github.com/llaville/php-compat-info/issues/292
 */
final class PhpFeaturesIssueTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'features' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #168
     *
     * @link https://github.com/llaville/php-compat-info/issues/168
     *       Wrong version on global const variable definition
     * @group regression
     * @return void
     */
    public function testRegressionGH168()
    {
        $dataSource = 'gh168.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $constants  = $metrics[self::$analyserId]['constants'];

        $this->assertEquals(
            '4.0.0',
            $constants['BAR']['php.min']
        );
        $this->assertEquals(
            '',
            $constants['BAR']['php.max']
        );

        $this->assertEquals(
            '5.3.0',
            $constants['FOO']['php.min']
        );
        $this->assertEquals(
            '',
            $constants['FOO']['php.max']
        );
    }

    /**
     * Regression test for feature #213
     *
     * @link https://github.com/llaville/php-compat-info/issues/213
     *       Dynamic access to static methods and properties are not detected
     * @link http://php.net/manual/en/migration53.new-features.php
     * @group features
     * @return void
     */
    public function testFeatureGH213()
    {
        $dataSource = 'gh213.php';
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
     * Regression test for feature #222
     *
     * @link https://github.com/llaville/php-compat-info/issues/222
     *       Negative constant marked as PHP 5.6
     * @group features
     * @return void
     */
    public function testFeatureGH222()
    {
        $dataSource = 'gh222.php';
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
     * Regression test for feature #228
     *
     * @link https://github.com/llaville/php-compat-info/issues/228
     *       `const FOO = null;` does not require PHP 5.6.0
     * @group features
     * @return void
     */
    public function testFeatureGH228()
    {
        $dataSource = 'gh228.php';
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
     * Regression test for feature #239
     *
     * @link https://github.com/llaville/php-compat-info/issues/239
     *       list short syntax available since PHP 7.1
     * @link https://wiki.php.net/rfc/short_list_syntax
     * @group features
     * @return void
     */
    public function testFeatureGH239()
    {
        $dataSource = 'gh239.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $errors     = $metrics['errors'];

        // no error detected since we use PHP-Parser 3.1 (for parsing PHP 5.2 to PHP 7.2)
        $this->assertCount(0, $errors);
    }

    /**
     * Regression test for feature #292
     *
     * @link https://github.com/llaville/php-compat-info/issues/292
     *       Uncaught Error: Object of class PhpParser\Node\UnionType could not be converted to string
     * @link https://wiki.php.net/rfc/union_types_v2
     * @group features
     * @return void
     */
    public function testFeatureGH292()
    {
        $dataSource = 'gh292.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            '8.0.0',
            $classes['ProxyManagerTestAsset\ClassWithPhp80TypedMethods']['php.min']
        );
        $this->assertEquals(
            '',
            $classes['ProxyManagerTestAsset\ClassWithPhp80TypedMethods']['php.max']
        );
    }
}
