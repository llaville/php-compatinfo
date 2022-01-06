<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Constant syntax/expressions.
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/140
 * @link https://github.com/llaville/php-compat-info/issues/158
 */
final class ConstSyntaxSniffTest extends SniffTestCase
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
     * Feature test for const keyword usage outside of object context
     *
     * @group features
     * @return void
     */
    public function testConstantOutsideObjectContext()
    {
        $dataSource = 'const_keyword.php';
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
     * Regression test for issue #140
     *
     * @link https://github.com/llaville/php-compat-info/issues/140
     *       Constant scalar expressions are 5.6+
     * @group regression
     * @return void
     */
    public function testConstantScalarExpressions()
    {
        $dataSource = 'gh140.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.6.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #158
     *
     * @link https://github.com/llaville/php-compat-info/issues/158
     *       Total requirements do not include Constants
     * @group regression
     * @return void
     */
    public function testTotalRequirementsWithConstant()
    {
        $dataSource = 'gh158.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '4.3.10',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
