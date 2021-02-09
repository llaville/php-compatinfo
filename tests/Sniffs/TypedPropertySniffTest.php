<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Typed properties available since PHP 7.4
 *
 * @since Class available since Release 5.4.0
 */
final class TypedPropertySniffTest extends SniffTestCase
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
     * Feature test on types properties declaration
     *
     * @group features
     * @return void
     */
    public function testTypedProperties()
    {
        $dataSource = 'typed_properties.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '7.4.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
