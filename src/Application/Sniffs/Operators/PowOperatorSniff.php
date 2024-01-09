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
 * Exponentiation via ** is PHP 5.6 or greater
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/pow-operator
 * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
 * @link https://www.php.net/manual/en/function.pow.php
 * @see tests/Sniffs/PowOperatorSniffTest
 */
final class PowOperatorSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA56 = 'CA5602';

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$this->isPowOperator($node)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.6.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA56);
        return null;
    }

    private function isPowOperator(Node $node): bool
    {
        return ($node instanceof Node\Expr\BinaryOp\Pow
            || $node instanceof Node\Expr\AssignOp\Pow
        );
    }

    public function getRules(): Generator
    {
        yield self::CA56 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Exponentiation via ** is available since PHP 5.6.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-56',
        ];
    }
}
