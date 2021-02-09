<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Short array syntax
 *
 * @link http://php.net/manual/en/migration54.new-features.php
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/148
 */
final class ShortArraySyntaxSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'arrays' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #148
     *
     * @link https://github.com/llaville/php-compat-info/issues/148
     *       Array short syntax and array dereferencing not detected
     * @group regression
     * @return void
     */
    public function testRegressionGH148()
    {
        $dataSource = 'gh148.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.4.0',
            $functions['returnArray']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['returnArray']['php.max']
        );

        $this->assertEquals(
            '5.3.0', // normal array syntax but inside a function of a namespace
            $functions['N\returnArray']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['N\returnArray']['php.max']
        );
    }
}
