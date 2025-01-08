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
 * Property hooks
 *
 * @author Laurent Laville
 * @since  Class available since Release 7.2.0
 * @group features
 * @see src/Application/Sniffs/Classes/PropertyHooksSniff
 */
final class PropertyHooksSniffTest extends SniffTestCase
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
     * @throws Exception
     */
    public function testVirtualPropertyHooks(): void
    {
        $dataSource = 'property_hooks.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            '8.4.0',
            $classes['Person']['php.min']
        );
        $this->assertEquals(
            '',
            $classes['Person']['php.max']
        );
    }

    /**
     * @throws Exception
     */
    public function testMagicConstantPropertyHooks(): void
    {
        $dataSource = 'magic_property_804.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            '8.4.0',
            $classes['User']['php.min']
        );
        $this->assertEquals(
            '',
            $classes['User']['php.max']
        );
    }
}
