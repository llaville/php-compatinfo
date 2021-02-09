<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Sniffs\ControlStructures;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Goto operator was added in PHP 5.3
 *
 * @link https://www.php.net/manual/en/control-structures.goto.php
 *
 * @see tests/Sniffs/GotoSniffTest
 * @since Class available since Release 5.4.0
 */
final class GotoSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Goto_) {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.3.0']);
    }
}
