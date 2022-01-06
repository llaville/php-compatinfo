<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\UseDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Use const, use function are PHP 5.6 or greater
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.use
 * @link https://wiki.php.net/rfc/use_function
 * @link https://www.php.net/manual/en/language.namespaces.importing.php
 * @see tests/Sniffs/UseConstFunctionSniffTest
 */
final class UseConstFunctionSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA56 = 'CA5603';

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$this->isUseConstFunction($node)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.6.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA56);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA56 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Use const, use function is allowed since PHP 5.6.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-56',
        ];
    }

    private function isUseConstFunction(Node $node): bool
    {
        return ($node instanceof Node\Stmt\Use_
            && in_array($node->type, [Node\Stmt\Use_::TYPE_FUNCTION, Node\Stmt\Use_::TYPE_CONSTANT])
        );
    }
}
