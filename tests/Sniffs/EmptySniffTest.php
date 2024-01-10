<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Empty expressions
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/pull/207
 * @link https://github.com/llaville/php-compat-info/issues/238
 */
final class EmptySniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'expressions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for pull request #207
     *
     * @link https://github.com/llaville/php-compat-info/pull/207
     *       Prior to PHP 5.5, empty() only supports variables
     * @link https://www.php.net/manual/en/migration55.new-features.php#migration55.new-features.empty
     * @group regression
     */
    public function testRegressionGH207(): void
    {
        $dataSource = 'gh207.php';
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
     * Regression test for issue #238
     *
     * @link https://github.com/llaville/php-compat-info/issues/238
     *       empty( self::$x ) reports 5.5.0
     * @group regression
     * @return void
     */
    public function testRegressionGH238()
    {
        $dataSource = 'gh238.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.0.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
