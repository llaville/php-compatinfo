<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Report use of magic methods
 *
 * @link https://www.php.net/manual/en/language.oop5.magic.php
 *
 * @since Class available since Release 5.4.0
 */
final class MagicMethodsSniffTest extends SniffTestCase
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
     * Feature test to detect magic methods since PHP 5.1
     *
     * @group features
     * @return void
     */
    public function testMagicMethodsInPHP51()
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
     * @return void
     */
    public function testMagicMethodsInPHP53()
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
     * @return void
     */
    public function testMagicMethodsInPHP56()
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
