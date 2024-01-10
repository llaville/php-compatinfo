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
 * @link https://github.com/llaville/php-compat-info/issues/153
 * @link https://github.com/llaville/php-compat-info/issues/155
 */
final class NamespaceIssueTest extends TestCase
{
    /**
     * @inheritDoc
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
     */
    public function testRegressionGH153(): void
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
     */
    public function testRegressionGH155(): void
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
