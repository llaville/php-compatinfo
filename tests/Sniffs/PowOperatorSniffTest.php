<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Exponentiation
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/142
 * @link https://github.com/llaville/php-compat-info/issues/211
 */
final class PowOperatorSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'operators' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #142
     *
     * @link https://github.com/llaville/php-compat-info/issues/142
     *       Exponentiation is 5.6+
     * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
     * @group regression
     */
    public function testRegressionGH142(): void
    {
        $dataSource = 'gh142.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.6.0',
            $functions['Name\Space\foo']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['Name\Space\foo']['php.max']
        );

        $this->assertEquals(
            '5.6.0',
            $functions['bar']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['bar']['php.max']
        );
    }

    /**
     * Regression test for issue #211
     *
     * @link https://github.com/llaville/php-compat-info/issues/211
     *       PHP 5.6 **-Operator not recognized
     * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
     * @group regression
     */
    public function testFeatureGH211(): void
    {
        $dataSource = 'gh211.php';
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
