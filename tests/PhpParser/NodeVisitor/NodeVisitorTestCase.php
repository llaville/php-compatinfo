<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\PhpParser\NodeVisitor;

use Bartlett\CompatInfo\Tests\TestCase;

/**
 * Base class for all node visitor test case
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 */
abstract class NodeVisitorTestCase extends TestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'visitors' . DIRECTORY_SEPARATOR;
    }
}
