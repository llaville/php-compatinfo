<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Typed properties are available since PHP 7.4
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/typed_properties_v2
 * @link https://www.php.net/manual/en/migration74.new-features.php#migration74.new-features.core.typed-properties
 * @link https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.typed-properties
 * @see tests/Sniffs/TypedPropertySniffTest
 */
final class TypedPropertySniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA74 = 'CA7401';

    /**
     * @inheritdoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Stmt\Property) {
            return null;
        }

        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        if (null !== $node->type) {
            $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '7.4.0']);
            $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA74);
        }
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA74 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Typed properties are available since PHP 7.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-74',
        ];
    }
}
