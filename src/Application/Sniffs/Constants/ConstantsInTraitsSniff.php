<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Constants;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Constants in Traits are available since PHP 8.2.0 beta3
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://wiki.php.net/rfc/constants_in_traits
 * @see tests/Sniffs/ConstantsInTraitsSniffTest
 */
final class ConstantsInTraitsSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA82 = 'CA8203';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA82 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Constants in Traits are available since PHP 8.2.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-82',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\ClassConst) {
            return null;
        }

        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }
        if (!$parent instanceof Node\Stmt\Trait_) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.2.0beta3']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA82);
        return null;
    }
}
