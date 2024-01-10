<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Goto operator
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/200
 */
final class GotoSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'controls' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #200
     *
     * @link https://github.com/llaville/php-compat-info/issues/200
     *       goto statement is not checked
     * @link https://www.php.net/manual/en/control-structures.goto.php
     * @group regression
     */
    public function testRegressionGH200(): void
    {
        $dataSource = 'gh200.php';
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
}
