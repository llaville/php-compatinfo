<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Expressions;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use Generator;
use PhpParser\Node;

/**
 * Static variable initializers available since PHP 8.3.0 alpha1
 *
 * @author Laurent Laville
 * @since  Class available since Release 7.1.0
 *
 * @link https://wiki.php.net/rfc/arbitrary_static_variable_initializers
 * @see tests/Sniffs/StaticVarInitializerSniffTest
 */
final class StaticVarInitializerSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA83 = 'CA8303';

    public function getRules(): Generator
    {
        yield self::CA83 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Static variable initializers syntax is available since PHP 8.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-83',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Stmt\StaticVar) {
            return null;
        }

        if ($node->default instanceof Node\Expr\CallLike && !$node->default instanceof Node\Expr\New_) {
            if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
                return null;
            }
            $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.3.0alpha1']);
            $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA83);
        }
        return null;
    }
}
