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
 * Class member access
 * - on instantiation (since PHP 5.4)
 * - on cloning (since PHP 7.0)
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/instance-method-call
 * @link https://www.php.net/manual/en/migration54.new-features.php
 * @see tests/Sniffs/ClassMemberAccessSniffTest
 */
final class ClassMemberAccessSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5404';
    private const CA70 = 'CA7004';

    /**
     * @inheritDoc
     */
    public function leaveNode(Node $node): array|int|Node|null
    {
        if (!$this->isClassMemberAccess($node)) {
            return null;
        }
        /** @var Node\Expr\MethodCall $node */

        $caller = $node->var;

        if ($caller instanceof Node\Expr\Clone_) {
            $min = '7.0.0';
            $id = self::CA70;
        } elseif ($caller instanceof Node\Expr\New_) {
            $min = '5.4.0';
            $id = self::CA54;
        } else {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, $id);
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Class member access on instantiation is available since PHP 5.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-54',
        ];
        yield self::CA70 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Class member access on cloning is available since PHP 7.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-70',
        ];
    }

    private function isClassMemberAccess(Node $node): bool
    {
        return ($node instanceof Node\Expr\MethodCall && $node->name instanceof Node\Identifier);
    }
}
