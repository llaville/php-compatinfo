<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\ControlStructures;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Goto operator was added in PHP 5.3
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/control-structures.goto.php
 * @see tests/Sniffs/GotoSniffTest
 */
final class GotoSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA53 = 'CA5303';

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Stmt\Goto_) {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.3.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA53);
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA53 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'The goto operator is available since PHP 5.3.0',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
        ];
    }
}
