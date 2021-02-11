<?php declare(strict_types=1);

/**
 * Use of CONST keyword outside of a class (since PHP 5.3)
 * @link https://www.php.net/manual/en/migration53.new-features.php
 *
 * Constant scalar expressions are PHP 5.6 or greater
 * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.const-scalar-exprs
 *
 * @see tests/Sniffs/ConstSyntaxSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Constants;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * @since Release 5.4.0
 */
final class ConstSyntaxSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Const_) {
            return null;
        }

        foreach ($node->consts as $const) {
            if ($const->value instanceof Node\Expr\ConstFetch) {
                $this->updateNodeElementVersion($const, $this->attributeKeyStore, ['php.min' => '5.3.0']);
            } elseif (!$const->value instanceof Node\Scalar) {
                $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.6.0']);
                return null;
            }
        }

        if (!$node->getAttribute($this->attributeParentKeyStore) instanceof Node\Stmt\ClassLike) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.3.0']);
        }
        return null;
    }
}
