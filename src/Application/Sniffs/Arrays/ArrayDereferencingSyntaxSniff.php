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
 * Array dereferencing syntax (since PHP 5.4)
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 * @see tests/Sniffs/ArrayDereferencingSyntaxSniffTest
 */
final class ArrayDereferencingSyntaxSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5402';

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (($node instanceof Node\Expr\ArrayDimFetch && $node->var instanceof Node\Expr\FuncCall) === false) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.4.0']);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA54);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Array dereferencing syntax is available since PHP 5.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-54',
        ];
    }
}
