<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Fibers;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Fibers since PHP 8.1
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/language.fibers.php
 * @link https://wiki.php.net/rfc/fibers
 * @link https://php.watch/versions/8.1/fibers
 * @see tests/Sniffs/FiberSniffTest
 */
final class FiberSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA81 = 'CA8109';

    public function getRules(): Generator
    {
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Fibers are available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Expr\New_) {
            return null;
        }

        if ($node->class instanceof Node\Stmt\Class_ && $node->class->name === null) {
            // anonymous class
            return null;
        }

        if (!$node->class instanceof Node\Name) {
            return null;
        }

        if ('Fiber' === (string) $node->class) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.1.0alpha1']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA81);
        }
        return null;
    }
}
