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
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Expr\StaticPropertyFetch;

use Generator;

/**
 * @author Laurent Laville
 * @since Release 6.4.0
 */
final class DynamicAccessSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA53M = 'CA5307';
    private const CA53P = 'CA5308';

    public function getRules(): Generator
    {
        yield self::CA53M => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Dynamic access to static methods is now possible since PHP 5.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
        ];
        yield self::CA53P => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Dynamic access to static properties is now possible since PHP 5.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
        ];
    }

    /**
     * @inheritDoc
     */
    public function leaveNode(Node $node): array|int|Node|null
    {
        $parent = $node->getAttribute($this->attributeParentKeyStore);

        if ($node instanceof StaticCall) {
            if ($node->class instanceof Node\Expr\Variable) {
                $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.3.0']);
                $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA53M);
            }
            return null;
        }

        if ($node instanceof StaticPropertyFetch) {
            if ($node->class instanceof Node\Expr\Variable) {
                $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.3.0']);
                $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA53P);
            }
        }
        return null;
    }
}
