<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Arrow functions are available since PHP 7.4
 *
 * @author Laurent Laville
 * @since Release 6.4.0
 *
 * @link https://www.php.net/manual/en/functions.arrow.php
 *
 * @see tests/Sniffs/ArrowFunctionSniffTest
 */
final class ArrowFunctionSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA74 = 'CA7403';

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA74 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Arrow functions were introduced in PHP 7.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-74',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Expr\ArrowFunction) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.4.0']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA74);
        }
        return null;
    }
}
