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
 * @author Laurent Laville
 * @since Release 5.4.0

 * Use of CONST keyword outside a class (since PHP 5.3)
 * @link https://www.php.net/manual/en/migration53.new-features.php
 *
 * Constant scalar expressions are PHP 5.6 or greater
 * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.const-scalar-exprs
 * @see tests/Sniffs/ConstSyntaxSniffTest
 */
final class ConstSyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA53 = 'CA5306';
    private const CA56 = 'CA5606';

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Const_) {
            return null;
        }

        foreach ($node->consts as $const) {
            if ($const->value instanceof Node\Expr\ConstFetch) {
                $this->updateNodeElementVersion($const, $this->attributeKeyStore, ['php.min' => '5.3.0']);
            } elseif (!$const->value instanceof Node\Scalar) {
                $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.6.0']);
                $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA56);
                return null;
            }
        }

        if (!$node->getAttribute($this->attributeParentKeyStore) instanceof Node\Stmt\ClassLike) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.3.0']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA53);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA53 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Use of CONST keyword outside a class is available since PHP 5.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
        ];
        yield self::CA56 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Constant scalar expressions are available since PHP 5.6.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-56',
        ];
    }
}
