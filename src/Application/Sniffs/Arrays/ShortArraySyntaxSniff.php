<?php declare(strict_types=1);

/**
 * Short array syntax (since PHP 5.4)
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/ShortArraySyntaxSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Arrays;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function is_string;

/**
 * @since Release 5.4.0
 */
final class ShortArraySyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5403';
    /** @var array<int, mixed> */
    private array $tokens;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->tokens = $this->visitor->getTokens();
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$this->isShortArraySyntax($node)) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.4.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA54);
        return null;
    }

    private function isShortArraySyntax(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');
        return ($node instanceof Node\Expr\Array_ && is_string($this->tokens[$i]));
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Short array syntax is available since PHP 5.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-54',
        ];
    }
}
