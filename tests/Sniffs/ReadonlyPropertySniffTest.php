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
 * Readonly Properties syntax (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties
 * @link https://wiki.php.net/rfc/readonly_properties_v2
 * @see tests/Sniffs/ReadonlyPropertySniffTest.php
 */
final class ReadonlyPropertySniffTest extends SniffTestCase
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
     * Feature test for Readonly properties
     *
     * @link https://github.com/llaville/php-compatinfo/issues/323
     *       Readonly Properties are detected as PHP 8.1
     * @group features
     * @throws Exception
     */
    public function testReadonlyProperties(): void
    {
        $dataSource = 'readonly_properties.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.1.0beta1',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
