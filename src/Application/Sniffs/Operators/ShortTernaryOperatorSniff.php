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
 * Use of Elvis syntax (middle portion of ternary operator missing) since PHP 5.3
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @since https://www.php.net/manual/en/migration53.php
 * @since https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
 * @see tests/Sniffs/ShortTernaryOperatorSniffTest
 */
final class ShortTernaryOperatorSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA53 = 'CA5304';

    /**
     * @inheritDoc
     */
    public function leaveNode(Node $node): array|int|Node|null
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

    public function getRules(): Generator
    {
        yield self::CA53 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Ternary operator ('?:') is allowed since PHP 5.3.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP53',
        ];
    }
}
