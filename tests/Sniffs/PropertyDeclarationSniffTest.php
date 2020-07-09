<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Property declaration
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/119
 */
final class PropertyDeclarationSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'classes' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #119
     *
     * @link https://github.com/llaville/php-compat-info/issues/119
     *       "private" keyword reports as "Required PHP 4.0.0 (min)"
     * @group regression
     * @return void
     */
    public function testRegressionGH119()
    {
        $dataSource = 'gh119.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            '5.0.0',
            $classes['Foo']['php.min']
        );
        $this->assertEquals(
            '',
            $classes['Foo']['php.max']
        );
    }
}
