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
 * First class callable syntax (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/functions.first_class_callable_syntax.php
 * @link https://wiki.php.net/rfc/first_class_callable_syntax
 * @link https://php.watch/versions/8.1/first-class-callable-syntax
 * @see tests/Sniffs/FirstClassCallableSniffTest.php
 */
final class FirstClassCallableSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA81 = 'CA8103';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "First class callable syntax is available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\CallLike) {
            return null;
        }
        if (!$node->isFirstClassCallable()) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.1.0beta1']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA81);
        return null;
    }
}
