<?php declare(strict_types=1);

/**
 * Use const, use function are PHP 5.6 or greater
 *
 * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.use
 * @link https://wiki.php.net/rfc/use_function
 * @link https://www.php.net/manual/en/language.namespaces.importing.php
 *
 * @see tests/Sniffs/UseConstFunctionSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\UseDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * @since Release 5.4.0
 */
final class UseConstFunctionSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->isUseConstFunction($node)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.6.0']);
    }

    private function isUseConstFunction(Node $node): bool
    {
        return ($node instanceof Node\Stmt\Use_
            && in_array($node->type, [Node\Stmt\Use_::TYPE_FUNCTION, Node\Stmt\Use_::TYPE_CONSTANT])
        );
    }
}
