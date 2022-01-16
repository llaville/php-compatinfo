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
 * Attributes since PHP 8.0.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/releases/8.0/en.php#attributes
 * @link https://wiki.php.net/rfc/attributes_v2
 * @link https://www.php.net/manual/en/language.attributes.php
 * @link https://php.watch/versions/8.0/attributes
 * @see tests/Sniffs/AttributeSniffTest
 */
final class AttributeSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA80 = 'CA8002';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Attributes are available since PHP 8.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-80',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\AttributeGroup) {
            return null;
        }
        if (empty($node->attrs)) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.0.0alpha1']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA80);
        return null;
    }
}
