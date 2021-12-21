<?php declare(strict_types=1);

/**
 * Typed properties are available since PHP 7.4
 *
 * @link https://wiki.php.net/rfc/typed_properties_v2
 * @link https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.typed-properties
 * @link https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.typed-properties
 *
 * @see tests/Sniffs/TypedPropertySniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class TypedPropertySniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA74 = 'CA7401';

    /**
     * {@inheritdoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Property) {
            return null;
        }

        if (null !== $node->type) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.4.0']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA74);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA74 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Typed properties are available since PHP 7.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-74',
        ];
    }
}
