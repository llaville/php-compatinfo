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

namespace Bartlett\Tests\CompatInfo;

/**
 * @link https://github.com/llaville/php-compat-info/issues/153
 * @link https://github.com/llaville/php-compat-info/issues/155
 */
final class NamespaceIssueTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'conditions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #153
     *
     * @link https://github.com/llaville/php-compat-info/issues/153
     *       "global namespace reports higher requirements than everything else"
     * @group regression
     * @return void
     */
    public function testRegressionGH153()
    {
        $dataSource = 'gh153.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.0.0',
            $functions['md5']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['md5']['php.max']
        );
    }

    /**
     * Regression test for issue #155
     *
     * @link https://github.com/llaville/php-compat-info/issues/155
     *       Results depend on lexical order of fallback implementations
     * @group regression
     * @return void
     */
    public function testRegressionGH155()
    {
        $dataSource = 'gh155.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '4.0.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );

        $this->assertEquals(
            '5.2.0',
            $functions['json_encode']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['json_encode']['php.max']
        );
        $this->assertTrue($functions['json_encode']['optional']);
    }
}
