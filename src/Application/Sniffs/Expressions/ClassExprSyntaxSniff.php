<?php declare(strict_types=1);

/**
 * Class::{expr}() syntax is available since PHP 5.4
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/ClassExprSyntaxSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Expressions;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class ClassExprSyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5405';

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$this->isClassExprSyntax($node)) {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.4.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA54);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Class::{expr}() syntax is available since PHP 5.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-54',
        ];
    }

    private function isClassExprSyntax(Node $node): bool
    {
        return ($node instanceof Node\Expr\StaticCall
            && $node->class instanceof Node\Name
            && $node->name instanceof Node\Scalar\String_
        );
    }
}
