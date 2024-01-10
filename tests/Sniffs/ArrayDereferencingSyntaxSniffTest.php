<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Array dereferencing syntax.
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/148
 */
final class ArrayDereferencingSyntaxSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
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
     */
    public function testRegressionGH148(): void
    {
        $dataSource = 'gh148.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $namespaces = $metrics[self::$analyserId]['namespaces'];

        $this->assertEquals(
            '5.4.0',
            $namespaces['']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['']['php.max']
        );

        $this->assertEquals(
            '5.4.0',
            $namespaces['N']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['N']['php.max']
        );
    }
}
