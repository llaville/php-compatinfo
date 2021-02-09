<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Sniffs\Arrays;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Short array syntax (since PHP 5.4)
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/ShortArraySyntaxSniffTest
 * @since Class available since Release 5.4.0
 */
final class ShortArraySyntaxSniff extends SniffAbstract
{
    private $tokens;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->tokens = $this->visitor->getTokens();
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node): void
    {
        if (!$this->isShortArraySyntax($node)) {
            return;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.4.0']);
    }

    private function isShortArraySyntax(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');
        return ($node instanceof Node\Expr\Array_ && is_string($this->tokens[$i]));
    }
}
