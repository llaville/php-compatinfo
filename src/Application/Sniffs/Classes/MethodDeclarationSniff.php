<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Class method declarations
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/language.oop5.visibility.php#language.oop5.visiblity-methods
 * @see tests/Sniffs/MethodDeclarationSniffTest
 */
final class MethodDeclarationSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA40 = 'CA4001';

    /**
     * @inheritdoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Stmt\ClassMethod) {
            return null;
        }

        if ($node->flags === 0) {
            // Checks if a method is implicitly public (PHP 4 syntax)
            $min = '4.0.0';
            $id = self::CA40;
        } else {
            $min = '5.0.0';
            $id = '';
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, $id);
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA40 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Checks if a method is implicitly public (PHP 4 syntax)',
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP50',
        ];
    }
}
