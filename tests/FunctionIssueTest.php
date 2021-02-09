<?php
/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 4.0.0-alpha2+1
 */

namespace Bartlett\CompatInfo\Tests;

/**
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
