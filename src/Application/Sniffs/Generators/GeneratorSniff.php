<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Generators;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Generators :
 * - was introduced in PHP 5.5
 * - delegate operations since PHP 7.0
 * - return expression since PHP 7.0
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/generators
 * @link https://wiki.php.net/rfc/generator-delegation
 * @link https://wiki.php.net/rfc/generator-return-expressions
 * @link https://www.php.net/manual/en/language.generators.php
 * @link https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.generator-return-expressions
 * @link https://www.php.net/manual/en/class.generator
 * @see tests/Sniffs/GeneratorSniffTest
 */
final class GeneratorSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA55 = 'CA5503';
    private const CA70 = 'CA7003';

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Expr\Yield_) {
            // introduction
            $min = '5.5.0';
            $id = self::CA55;
        } elseif ($node instanceof Node\Expr\YieldFrom) {
            // delegation
            $min = '7.0.0';
            $id = self::CA70;
        } else {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, $id);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA55 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Generators was introduced in PHP 5.5.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-55',
        ];
        yield self::CA70 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Generators delegate operations are available since PHP 7.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-70',
        ];
    }
}
