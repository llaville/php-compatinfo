<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Class member access
 * - on instantiation (since PHP 5.4)
 * - on cloning (since PHP 7.0)
 *
 * @link https://wiki.php.net/rfc/instance-method-call
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/ClassMemberAccessSniffTest
 * @since Class available since Release 5.4.0
 */
final class ClassMemberAccessSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$this->isClassMemberAccess($node)) {
            return null;
        }
        /** @var Node\Expr\MethodCall $node */

        $caller = $node->var;

        if ($caller instanceof Node\Expr\Clone_) {
            $min = '7.0.0';
        } elseif ($caller instanceof Node\Expr\New_) {
            $min = '5.4.0';
        } else {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
    }

    private function isClassMemberAccess(Node $node): bool
    {
        return ($node instanceof Node\Expr\MethodCall && $node->name instanceof Node\Identifier);
    }
}
