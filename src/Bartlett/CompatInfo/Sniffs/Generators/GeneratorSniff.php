<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Generators;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Generators :
 * - was introduced in PHP 5.5
 * - delegate operations since PHP 7.0
 * - return expression since PHP 7.0
 *
 * @link https://wiki.php.net/rfc/generators
 * @link https://wiki.php.net/rfc/generator-delegation
 * @link https://wiki.php.net/rfc/generator-return-expressions
 * @link https://www.php.net/manual/en/language.generators.php
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.generator-return-expressions
 * @link https://www.php.net/manual/en/class.generator
 *
 * @see tests/Sniffs/GeneratorSniffTest
 * @since Class available since Release 5.4.0
 */
final class GeneratorSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Expr\Yield_) {
            // introduction
            $min = '5.5.0';
        } elseif ($node instanceof Node\Expr\YieldFrom) {
            // delegation
            $min = '7.0.0';
        } else {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
    }
}
