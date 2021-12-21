<?php declare(strict_types=1);

/**
 * Empty expressions
 *
 * @link https://wiki.php.net/rfc/empty_isset_exprs
 * @link https://www.php.net/manual/en/migration55.new-features.php#migration55.new-features.empty
 * @link https://www.php.net/manual/en/function.empty.php
 *
 * @see tests/Sniffs/EmptySniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Expressions;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class EmptySniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA55 = 'CA5502';

    /**
     * {@inheritdoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\Empty_) {
            return null;
        }

        // If the parameter of empty() is an arbitrary expression, and not just a variable.
        if (
            ! $node->expr instanceof Node\Expr\Variable
            && ! $node->expr instanceof Node\Expr\ArrayDimFetch
            && ! $node->expr instanceof Node\Expr\PropertyFetch
            && ! $node->expr instanceof Node\Expr\StaticPropertyFetch
        ) {
            // Prior to PHP 5.5, empty() only supports variables
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.5.0']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA55);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA55 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Empty expressions are available since PHP 5.5.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-55',
        ];
    }
}
