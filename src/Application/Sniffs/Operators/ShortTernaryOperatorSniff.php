<?php declare(strict_types=1);

/**
 * Use of Elvis syntax (middle portion of ternary operator missing) since PHP 5.3
 *
 * @since https://www.php.net/manual/en/migration53.php
 * @since https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
 *
 * @see tests/Sniffs/ShortTernaryOperatorSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Operators;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * @since Release 5.4.0
 */
final class ShortTernaryOperatorSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA53 = 'CA5304';

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Expr\Ternary) {
            return null;
        }

        if (null === $node->if) {
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
            'fullDescription' => "Ternary operator ('?:') is allowed since PHP 5.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
        ];
    }
}
