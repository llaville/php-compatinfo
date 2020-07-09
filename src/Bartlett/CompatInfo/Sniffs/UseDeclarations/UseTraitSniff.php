<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\UseDeclarations;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Use trait is PHP 5.4 or greater
 *
 * @link https://www.php.net/manual/en/language.oop5.traits.php
 *
 * @see tests/Sniffs/UseTraitSniffTest
 * @since Class available since Release 5.4.0
 */
final class UseTraitSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\TraitUse) {
            return;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.4.0']);
    }
}
