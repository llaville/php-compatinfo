<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Arrays;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;
use PhpParser\NodeFinder;

use Generator;
use function is_string;

/**
 * Array unpacking support :
 * - for numeric-keyed arrays (since PHP 7.4)
 * - for string-keyed arrays (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/spread_operator_for_array
 * @link https://www.php.net/releases/8.1/en.php#array_unpacking_support_for_string_keyed_arrays
 * @link https://wiki.php.net/rfc/array_unpacking_string_keys
 * @link https://www.php.net/manual/en/language.types.array.php#language.types.array.unpacking
 * @link https://php.watch/versions/8.1/spread-operator-string-array-keys
 * @see tests/Sniffs/ArrayUnpackingSyntaxSniffTest.php
 */
final class ArrayUnpackingSyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA74 = 'CA7402';
    private const CA81 = 'CA8110';

    public function getRules(): Generator
    {
        yield self::CA74 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Array unpacking support is available since PHP 7.4.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP74',
        ];
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Array unpacking support for string keys is available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP81',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Expr\ArrayItem) {
            return null;
        }
        if (!$node->unpack) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        if (!($node->value instanceof Node\Expr\Variable && is_string($node->value->name))) {
            return null;
        }

        // start searching for ... array variable in current scope
        $name = $node->value->name;
        do {
            //$parent = $node->getAttribute($this->attributeParentKeyStore);
            $scope = $parent;
            /** @var Node\Expr\Assign|null $assignExpr */
            $assignExpr = $this->assignFinder($scope, $name);
            if ($assignExpr !== null) {
                // variable assignment found !
                break;
            }
            // search continue ... on parent scope
            $parent = $scope->getAttribute($this->attributeParentKeyStore);
        } while ($parent !== null);

        if (null === $assignExpr) {
            return null;
        }

        // Array unpacking support
        $phpMin = '7.4.0';
        $ruleId = self::CA74;

        /** @var Node\Expr\Array_ $arrayExpr */
        $arrayExpr = $assignExpr->expr;

        // checks array keys
        foreach ($arrayExpr->items as $arrayItemExpr) {
            if ($arrayItemExpr->key === null && $arrayItemExpr->value instanceof Node\Scalar\String_) {
                $phpMin = '8.1.0';
                $ruleId = self::CA81;
                break;
            }
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => $phpMin]);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, $ruleId);
        return null;
    }

    private function assignFinder(Node $scope, string $name): ?Node
    {
        $nodeFinder = new NodeFinder();

        return $nodeFinder->findFirst($scope, function (Node $node) use ($name) {
            return $node instanceof Node\Expr\Assign
                && $node->expr instanceof Node\Expr\Array_
                && $node->var instanceof Node\Expr\Variable
                && is_string($node->var->name)
                && $node->var->name === $name;
        });
    }
}
