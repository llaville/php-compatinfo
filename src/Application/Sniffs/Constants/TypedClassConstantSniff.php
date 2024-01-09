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
 * Typed hinting class constants has been introduced in PHP 8.3
 *
 * @author Laurent Laville
 * @since Release 7.1.0
 *
 * @see tests/Sniffs/TypedClassConstantSniffTest
 */
final class TypedClassConstantSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA83 = 'CA8301';

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Stmt\ClassConst) {
            return null;
        }

        if ($node->type instanceof Node\Identifier) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.3.0alpha1']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA83);
        }
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA83 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Type hinting class constants has been introduced in PHP 8.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-83',
        ];
    }
}
