<?php declare(strict_types=1);

/**
 * The Foo\Bar::class syntax has been introduced in PHP 5.5
 *
 * @link https://wiki.php.net/rfc/class_name_literal_on_object
 *
 * @see tests/Sniffs/MagicClassConstantSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Constants;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;
use PhpParser\Node;

use function strcasecmp;

/**
 * @since Release 5.4.0
 */
final class MagicClassConstantSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\ClassConstFetch) {
            return null;
        }

        if (!($node->name instanceof Node\Identifier && strcasecmp('class', (string) $node->name) === 0)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.5.0']);
    }
}
