<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

use Exception;

/**
 * Class constants
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/215
 */
final class ClassConstantSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'constants' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #215
     *
     * @link https://github.com/llaville/php-compat-info/issues/215
     *       Constant expressions with scalar expression not detected
     * @group regression
     * @throws Exception
     */
    public function testRegressionGH215(): void
    {
        $dataSource = 'gh215.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $constants  = $metrics[self::$analyserId]['constants'];

        $this->assertEquals(
            '4.0.0',
            $constants['C\THREE']['php.min']
        );

        $this->assertEquals(
            '',
            $constants['C\THREE']['php.max']
        );
    }

    /**
     * Feature test for final class constants
     *
     * @link https://github.com/llaville/php-compatinfo/issues/328
     *       Final class constants are detected as PHP 8.1
     * @group features
     * @throws Exception
     */
    public function testFinalClassConstants(): void
    {
        $dataSource = 'final_const.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $constants  = $metrics[self::$analyserId]['constants'];

        $this->assertEquals(
            '8.1.0beta1',
            $constants['Foo\XX']['php.min']
        );

        $this->assertEquals(
            '',
            $constants['Foo\XX']['php.max']
        );
    }
}
