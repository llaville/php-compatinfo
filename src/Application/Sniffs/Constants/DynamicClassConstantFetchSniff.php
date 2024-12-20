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
 * Dynamic class constant fetch syntax is available since PHP 8.3.0 alpha1
 *
 * @author Laurent Laville
 * @since  Class available since Release 7.1.0
 *
 * @link https://wiki.php.net/rfc/dynamic_class_constant_fetch
 * @link https://stitcher.io/blog/new-in-php-83#dynamic-class-constant-fetch-rfc
 * @see tests/Sniffs/DynamicClassConstantFetchSniffTest
 */
final class DynamicClassConstantFetchSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA83 = 'CA8304';

    public function getRules(): Generator
    {
        yield self::CA83 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Dynamic class constant fetch syntax is available since PHP 8.3.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP83',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Expr\ClassConstFetch) {
            return null;
        }

        if ($node->name instanceof Node\Expr\Variable) {
            if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
                return null;
            }
            $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.3.0alpha1']);
            $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA83);
        }
        return null;
    }
}
