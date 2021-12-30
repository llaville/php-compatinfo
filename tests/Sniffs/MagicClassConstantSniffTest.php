<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Magic class constant (::class)
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/218
 */
final class MagicClassConstantSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'constants' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for fetching class name on objects (::class) detection
     *
     * @group features
     * @return void
     */
    public function testFetchingClassNameOnObjects()
    {
        $dataSource = 'class.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.5.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #218
     *
     * @link https://github.com/llaville/php-compat-info/issues/218
     *       "::class" not detected as php 5.5
     * @link https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.class.class
     * @group regression
     * @return void
     */
    public function testRegressionGH218()
    {
        $dataSource = 'gh218.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.5.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
