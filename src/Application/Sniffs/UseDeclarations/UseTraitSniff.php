<?php declare(strict_types=1);

/**
 * Use trait is PHP 5.4 or greater
 *
 * @link https://www.php.net/manual/en/language.oop5.traits.php
 *
 * @see tests/Sniffs/UseTraitSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\UseDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * @since Release 5.4.0
 */
final class UseTraitSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\TraitUse) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.4.0']);
    }
}
