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
 * Match expressions (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/control-structures.match.php
 * @link https://wiki.php.net/rfc/match_expression_v2
 * @link https://php.watch/versions/8.0/match-expression
 * @see tests/Sniffs/MatchSniffTest
 */
final class MatchSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA80 = 'CA8004';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Match expressions are available since PHP 8.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-80',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\Match_) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }
        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.0.0alpha3']);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA80);
        return null;
    }
}
