<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * @link https://github.com/llaville/php-compat-info/issues/220
 */
final class CryptStringSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
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
     * @return void
     */
    public function testRegressionGH220()
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
