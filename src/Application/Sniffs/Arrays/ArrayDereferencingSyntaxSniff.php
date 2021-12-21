<?php declare(strict_types=1);

/**
 * Array dereferencing syntax (since PHP 5.4)
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/ArrayDereferencingSyntaxSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Arrays;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class ArrayDereferencingSyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5402';

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (($node instanceof Node\Expr\ArrayDimFetch && $node->var instanceof Node\Expr\FuncCall) === false) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.4.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA54);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Array dereferencing syntax is available since PHP 5.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-54',
        ];
    }
}
