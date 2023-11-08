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
 * SensitiveParameter attribute is available since PHP 8.2.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://www.php.net/manual/en/class.sensitiveparameter
 * @see tests/Sniffs/SensitiveParameterAttributeSniffTest
 */
final class SensitiveParameterAttributeSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA82 = 'CA8205';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA82 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "SensitiveParameter attribute is available since PHP 8.2.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-82',
        ];
    }

    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\AttributeGroup) {
            return null;
        }
        $found = false;
        foreach ($node->attrs as $attr) {
            if ($attr->name->toString() == 'SensitiveParameter') {
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
        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.all' => '8.2.0alpha1']);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA82);
        return null;
    }
}
