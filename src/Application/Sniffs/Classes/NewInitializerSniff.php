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
use PhpParser\Node\Expr\New_;

use Generator;

/**
 * New in initializers (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/migration81.new-features.php#migration81.new-features.core.new-in-initializer
 * @link https://wiki.php.net/rfc/new_in_initializers
 * @link https://stitcher.io/blog/php-81-new-in-initializers
 * @see tests/Sniffs/ParamValueDeclarationSniffTest.php
 */
final class NewInitializerSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA81 = 'CA8104';

    public function getRules(): Generator
    {
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "New in initializers is available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        $newExpr = $this->getNewInInitializers($node);
        if ($newExpr instanceof New_) {
            $this->updateNodeElementVersion($newExpr, $this->attributeKeyStore, ['php.min' => '8.1.0beta1']);
            $this->updateNodeElementRule($newExpr, $this->attributeKeyStore, self::CA81);
        }
        return null;
    }

    private function getNewInInitializers(Node $node): ?New_
    {
        if ($node instanceof Node\Param) {
            if ($node->default instanceof New_) {
                return $node->default;
            }
        } elseif ($node instanceof Node\Stmt\StaticVar) {
            if ($node->default instanceof New_) {
                return $node->default;
            }
        } elseif ($node instanceof Node\Const_) {
            if ($node->value instanceof New_) {
                return $node->value;
            }
        }
        return null;
    }
}
