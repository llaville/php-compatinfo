<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Operators;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Exponentiation is PHP 5.6 or greater
 *
 * @link https://wiki.php.net/rfc/pow-operator
 * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
 * @link https://www.php.net/manual/en/function.pow.php
 *
 * @see tests/Sniffs/PowOperatorSniffTest
 * @since Class available since Release 5.4.0
 */
final class PowOperatorSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->isPowOperator($node)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.6.0']);
    }

    private function isPowOperator(Node $node): bool
    {
        return ($node instanceof Node\Expr\BinaryOp\Pow
            || $node instanceof Node\Expr\AssignOp\Pow
        );
    }
}
