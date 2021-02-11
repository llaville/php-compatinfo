<?php declare(strict_types=1);

/**
 * Class::{expr}() syntax is available since PHP 5.4
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/ClassExprSyntaxSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Expressions;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * @since Release 5.4.0
 */
final class ClassExprSyntaxSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$this->isClassExprSyntax($node)) {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.4.0']);
        return null;
    }

    private function isClassExprSyntax(Node $node): bool
    {
        return ($node instanceof Node\Expr\StaticCall
            && $node->class instanceof Node\Name
            && $node->name instanceof Node\Scalar\String_
        );
    }
}
