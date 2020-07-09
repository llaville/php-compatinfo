<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

use Bartlett\CompatInfo\Collection\SniffCollection;
use Bartlett\Tests\CompatInfo\TestCase;

/**
 * Base class for all sniffs test case
 *
 * @since Class available since Release 5.4.0
 */
abstract class SniffTestCase extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'sniffs' . DIRECTORY_SEPARATOR;

        $container = require __DIR__ . '/../../config/container.php';
        self::$sniffs = $container->get(SniffCollection::class);
    }
}
