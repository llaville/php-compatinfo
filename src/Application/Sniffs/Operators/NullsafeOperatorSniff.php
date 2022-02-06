<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Operators;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Nullsafe operator (available since PHP 8.0.0 beta1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/nullsafe_operator
 * @link https://php.watch/versions/8.0/null-safe-operator
 * @see tests/Sniffs/NullsafeOperatorSniffTest
 */
final class NullsafeOperatorSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA80 = 'CA8005';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Nullsafe operator is available since PHP 8.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-80',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (
            !$node instanceof Node\Expr\NullsafePropertyFetch
            && !$node instanceof Node\Expr\NullsafeMethodCall
        ) {
            return null;
        }

        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.0.0beta1']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA80);
        return null;
    }
}
