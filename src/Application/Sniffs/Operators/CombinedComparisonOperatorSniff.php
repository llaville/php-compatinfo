<?php declare(strict_types=1);

/**
 * Combined Comparison (Spaceship) Operator since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/combined-comparison-operator
 *
 * @see tests/Sniffs/CombinedComparisonOperatorSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Operators;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class CombinedComparisonOperatorSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA70 = 'CA7006';

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\BinaryOp\Spaceship) {
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
            'fullDescription' => "Combined Comparison (Spaceship) Operator is available since PHP 7.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-70',
        ];
    }
}
