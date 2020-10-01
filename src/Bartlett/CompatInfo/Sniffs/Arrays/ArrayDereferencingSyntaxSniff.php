<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Arrays;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Array dereferencing syntax (since PHP 5.4)
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/ArrayDereferencingSyntaxSniffTest
 * @since Class available since Release 5.4.0
 */
final class ArrayDereferencingSyntaxSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node): void
    {
        if (($node instanceof Node\Expr\ArrayDimFetch && $node->var instanceof Node\Expr\FuncCall) === false) {
            return;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.4.0']);
    }
}
