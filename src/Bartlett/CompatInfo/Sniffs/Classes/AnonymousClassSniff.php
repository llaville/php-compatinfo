<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Classes;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Anonymous classes since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/anonymous_classes
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.anonymous-classes
 *
 * @see tests/Sniffs/AnonymousClassSniffTest
 * @since Class available since Release 5.4.0
 */
final class AnonymousClassSniff extends SniffAbstract
{
    /**
     * Process this sniff only on this scope.
     *
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->isAnonymousClass($node)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.0.0alpha1']);
    }

    private function isAnonymousClass(Node $node): bool
    {
        return ($node instanceof Node\Expr\New_ && $node->class instanceof Node\Stmt\Class_);
    }
}
