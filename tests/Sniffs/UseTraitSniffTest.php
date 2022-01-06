<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Traits
 *
 * @author Laurent Laville
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/227
 */
final class UseTraitSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'traits' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #227
     *
     * @link https://github.com/llaville/php-compat-info/issues/227
     *       Does not detect Use traits
     * @group regression
     * @return void
     */
    public function testRegressionGH227()
    {
        $dataSource = 'gh227.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            '5.4.0',
            $classes['A']['php.min']
        );
        $this->assertEquals(
            '',
            $classes['A']['php.max']
        );
    }
}
