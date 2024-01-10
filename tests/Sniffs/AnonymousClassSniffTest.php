<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Anonymous classes.
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/anonymous_classes
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.anonymous-classes
 * @link https://github.com/llaville/php-compat-info/issues/269
 */
final class AnonymousClassSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'classes' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #269
     *
     * @link https://github.com/llaville/php-compat-info/issues/269
     *       Anonymous class is detected as PHP 5.4
     * @group regression
     */
    public function testAnonymousClassInProceduralContext(): void
    {
        $dataSource = 'anonymous_classes.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '7.0.0alpha1',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
