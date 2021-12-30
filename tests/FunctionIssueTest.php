<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests;

/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * @author Laurent Laville
 * @author Remi Collet
 * @since  Class available since Release 4.0.0-alpha2+1
 *
 * @link https://github.com/llaville/php-compat-info/issues/130
 */
final class FunctionIssueTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'features' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #130
     *
     * @link https://github.com/llaville/php-compat-info/issues/130
     *       "Conditionally called function is reported as interface"
     * @group regression
     * @return void
     */
    public function testRegressionGH130()
    {
        $dataSource = 'gh130.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '4.0.0',
            $functions['foo']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['foo']['php.max']
        );
        $this->assertTrue(
            $functions['foo']['optional'] ?? false,
            'Expected optional foo function, none specified.'
        );
    }
}
