<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

use Exception;

/**
 * Enumerations.
 *
 * @author Laurent Laville
 * @since  Class available since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/enumerations
 * @link https://www.php.net/manual/en/language.enumerations.php
 * @link https://github.com/llaville/php-compatinfo/issues/322
 */
final class EnumerationSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'enumerations' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #322
     *
     * @link https://github.com/llaville/php-compatinfo/issues/322
     *       Enumeration is detected as PHP 8.1
     * @group regression
     * @return void
     * @throws Exception
     */
    public function testBasicEnumerations()
    {
        $dataSource = 'basic.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.1.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Regression test for issue #322
     *
     * @link https://github.com/llaville/php-compatinfo/issues/322
     *       Enumeration is detected as PHP 8.1
     * @group regression
     * @return void
     * @throws Exception
     */
    public function testBackedEnumerations()
    {
        $dataSource = 'backed.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.1.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
