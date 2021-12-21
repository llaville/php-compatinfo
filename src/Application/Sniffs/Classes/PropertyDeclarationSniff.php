<?php declare(strict_types=1);

/**
 * Property declarations
 *
 * @link https://www.php.net/manual/en/language.oop5.properties.php
 * @link https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visibility-members
 *
 * @see tests/Sniffs/PropertyDeclarationSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class PropertyDeclarationSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA40 = 'CA4003';

    /**
     * {@inheritdoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Property) {
            return null;
        }

        if ($node->flags === 0) {
            // Checks if a property is implicitly public (PHP 4 syntax)
            $min = '4.0.0';
            $id = self::CA40;
        } else {
            $min = '5.0.0';
            $id = '';
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, $id);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA40 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Checks if a property is implicitly public (PHP 4 syntax)',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-50',
        ];
    }
}
