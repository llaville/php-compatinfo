<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/220
 */
final class CryptStringSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'strings' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #220
     *
     * @link https://github.com/llaville/php-compat-info/issues/220
     *       "Did not detect Blowfish on crypt"
     * @group regression
     */
    public function testRegressionGH220(): void
    {
        $dataSource = 'gh220.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.3.7',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
