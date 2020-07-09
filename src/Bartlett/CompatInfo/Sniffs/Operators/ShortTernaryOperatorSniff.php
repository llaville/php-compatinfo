<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Operators;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Use of Elvis syntax (middle portion of ternary operator missing) since PHP 5.3
 *
 * @since https://www.php.net/manual/en/migration53.php
 * @since https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
 *
 * @see tests/Sniffs/ShortTernaryOperatorSniffTest
 * @since Class available since Release 5.4.0
 */
final class ShortTernaryOperatorSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Expr\Ternary) {
            return null;
        }

        if (null === $node->if) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.3.0']);
        }
    }
}
