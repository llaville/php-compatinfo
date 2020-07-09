<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\PhpParser\NodeVisitor;

use Bartlett\Tests\CompatInfo\TestCase;

/**
 * Base class for all node visitor test case
 *
 * @since Class available since Release 5.4.0
 */
abstract class NodeVisitorTestCase extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'visitors' . DIRECTORY_SEPARATOR;
    }
}
