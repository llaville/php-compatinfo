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
 * Null Coalescing Operator (??) available since PHP 7.0.0alpha1
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/isset_ternary
 * @link https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.coalesce
 * @see tests/Sniffs/NullCoalesceOperatorSniffTest
 */
final class NullCoalesceOperatorSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA70 = 'CA7005';

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Expr\BinaryOp\Coalesce) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.0.0alpha1']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA70);
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA70 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Null Coalescing Operator ('??') is available since PHP 7.0.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP70',
        ];
    }
}
