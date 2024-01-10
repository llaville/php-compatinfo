<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Report use of magic methods
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/language.oop5.magic.php
 */
final class MagicMethodsSniffTest extends SniffTestCase
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
     * Feature test to detect magic methods since PHP 5.1
     *
     * @group features
     */
    public function testMagicMethodsInPHP51(): void
    {
        $dataSource = 'magic_methods_501.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.1.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Feature test to detect magic methods since PHP 5.3
     *
     * @group features
     */
    public function testMagicMethodsInPHP53(): void
    {
        $dataSource = 'magic_methods_503.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.3.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }

    /**
     * Feature test to detect magic methods since PHP 5.6
     *
     * @group features
     */
    public function testMagicMethodsInPHP56(): void
    {
        $dataSource = 'magic_methods_506.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.6.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
