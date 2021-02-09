<?php declare(strict_types=1);

/**
 * Base class for all node visitor test case
 */
namespace Bartlett\CompatInfo\Tests\PhpParser\NodeVisitor;

use Bartlett\CompatInfo\Tests\TestCase;

/**
 * @since Release 5.4.0
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
