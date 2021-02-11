<?php declare(strict_types=1);

/**
 * Class method declarations
 *
 * @link https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visiblity-methods
 *
 * @see tests/Sniffs/MethodDeclarationSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * @since Release 5.4.0
 */
final class MethodDeclarationSniff extends SniffAbstract
{
    /**
     * {@inheritdoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\ClassMethod) {
            return null;
        }

        if ($node->flags === 0) {
            // Checks if a method is implicitly public (PHP 4 syntax)
            $min = '4.0.0';
        } else {
            $min = '5.0.0';
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
        return null;
    }
}
