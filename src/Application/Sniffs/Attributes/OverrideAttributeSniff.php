<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Attributes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Override attribute since PHP 8.3.0 alpha3
 *
 * @author Laurent Laville
 * @since Release 7.1.0
 *
 * @link https://wiki.php.net/rfc/marking_overriden_methods
 * @link https://stitcher.io/blog/new-in-php-83##%5Boverride%5D-attribute-rfc
 * @see tests/Sniffs/OverrideAttributeSniffTest
 */
final class OverrideAttributeSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA83 = 'CA8302';

    /**
     * @inheritDoc
     */
    public function getRules(): Generator
    {
        yield self::CA83 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Override attribute is available since PHP 8.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-83',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\AttributeGroup) {
            return null;
        }
        $found = false;
        foreach ($node->attrs as $attr) {
            if ($attr->name->toString() == 'Override') {
                $found = true;
                break;
            }
        }
        if (!$found) {
            return null;
        }

        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }
        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.all' => '8.3.0alpha3']);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA83);
        return null;
    }
}
