<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Class member access.
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/154
 */
final class ClassMemberAccessSniffTest extends SniffTestCase
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
     * Regression test for issue #154
     *
     * @link https://github.com/llaville/php-compat-info/issues/154
     *       Class member access on instantiation
     * @group regression
     * @return void
     */
    public function testClassMemberAccessOnInstantiation()
    {
        $dataSource = 'gh154.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.4.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Feature test for Class member access on cloning detection
     *
     * @group features
     * @return void
     */
    public function testClassMemberAccessOnCloning()
    {
        $dataSource = 'member_access_on_cloning.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '7.0.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
