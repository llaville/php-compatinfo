<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Variadic functions
 *
 * @author Laurent Laville
 * @since Class available since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/variadics
 * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.variadics
 * @link https://github.com/llaville/php-compat-info/issues/141
 * @link https://github.com/llaville/php-compat-info/issues/141
 */
final class VariadicFunctionSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'functions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for variadic functions
     *
     * @group features
     * @return void
     */
    public function testVariadicFunctions()
    {
        $dataSource = 'variadic_functions.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.6.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );

        // variadic function in global namespace
        $this->assertEquals(
            '5.6.0',
            $functions['variadic']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['variadic']['php.max']
        );

        // variadic function in user namespace
        $this->assertEquals(
            '5.6.0',
            $functions['N\variadic']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['N\variadic']['php.max']
        );
    }

    /**
     * Regression test for issue #141
     *
     * @link https://github.com/llaville/php-compat-info/issues/141
     *       Variadic functions are 5.6+
     * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.variadics
     * @group regression
     * @return void
     */
    public function testRegressionGH141()
    {
        $dataSource = 'gh141.php';
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
}
