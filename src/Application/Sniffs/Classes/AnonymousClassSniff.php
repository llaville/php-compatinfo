<?php declare(strict_types=1);

/**
 * Anonymous classes since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/anonymous_classes
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.anonymous-classes
 *
 * @see tests/Sniffs/AnonymousClassSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class AnonymousClassSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA70 = 'CA7009';

    /**
     * Process this sniff only on this scope.
     *
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->isAnonymousClass($node)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.0.0alpha1']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA70);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA70 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Anonymous classes are available since PHP 7.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-70',
        ];
    }

    private function isAnonymousClass(Node $node): bool
    {
        return ($node instanceof Node\Expr\New_ && $node->class instanceof Node\Stmt\Class_);
    }
}
