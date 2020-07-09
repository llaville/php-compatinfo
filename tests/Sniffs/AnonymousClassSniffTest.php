<?php
/**
 * Unit tests for PHP_CompatInfo package, anonymous class sniff
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 5.4.0
 */

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Anonymous classes.
 *
 * @link https://wiki.php.net/rfc/anonymous_classes
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.anonymous-classes
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/269
 */
final class AnonymousClassSniffTest extends SniffTestCase
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
     * Regression test for issue #269
     *
     * @link https://github.com/llaville/php-compat-info/issues/269
     *       Anonymous class is detected as PHP 5.4
     * @group regression
     * @return void
     */
    public function testAnonymousClassInProceduralContext()
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
