<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Arrays;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Array unpacking support :
 * - for numeric-keyed arrays (since PHP 7.4)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/spread_operator_for_array
 * @link https://www.php.net/manual/en/language.types.array.php#language.types.array.unpacking
 * @see tests/Sniffs/ArrayUnpackingSyntaxSniffTest.php
 */
final class ArrayUnpackingSyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA74 = 'CA7402';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA74 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Array unpacking support is available since PHP 7.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-74',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\ArrayItem) {
            return null;
        }
        if (!$node->unpack) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        // Array unpacking support
        $phpMin = '7.4.0';
        $ruleId = self::CA74;

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => $phpMin]);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, $ruleId);
        return null;
    }
}
