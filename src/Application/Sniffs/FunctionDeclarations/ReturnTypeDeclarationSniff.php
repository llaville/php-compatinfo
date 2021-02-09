<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Return Type Declarations since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/return_types
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.return-type-declarations
 *
 * @see tests/Sniffs/ReturnTypeDeclarationSniffTest
 * @since Class available since Release 5.4.0
 */
final class ReturnTypeDeclarationSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->hasReturnType($node)) {
            return null;
        }

        $returnType = $node->getReturnType();

        if ($returnType instanceof Node\NullableType) {
            // @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types
            $min = '7.1.0';
        } elseif ($returnType instanceof Node\Identifier && strcasecmp($returnType->name, 'void') === 0) {
            // @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.void-functions
            $min = '7.1.0';
        } else {
            $min = '7.0.0alpha1';
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
    }

    private function hasReturnType(Node $node): bool
    {
        if ($node instanceof Node\FunctionLike) {
            return (null !== $node->getReturnType());
        }
        return false;
    }
}
