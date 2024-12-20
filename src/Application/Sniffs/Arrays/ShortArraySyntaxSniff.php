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

use Generator;
use function is_string;

/**
 * Short array syntax (since PHP 5.4)
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 * @see tests/Sniffs/ShortArraySyntaxSniffTest
 */
final class ShortArraySyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5403';
    /** @var array<int, mixed> */
    private array $tokens;

    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->tokens = $this->visitor->getTokens();
    }

    /**
     * @inheritDoc
     */
    public function leaveNode(Node $node): array|int|Node|null
    {
        if (!$this->isShortArraySyntax($node)) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.4.0']);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA54);
        return null;
    }

    private function isShortArraySyntax(Node $node): bool
    {
        if (!$node instanceof Node\Expr\Array_) {
            return false;
        }
        $i = $node->getAttribute('startTokenPos');
        return '[' == $this->tokens[$i]->text;
    }

    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Short array syntax is available since PHP 5.4.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP54',
        ];
    }
}
