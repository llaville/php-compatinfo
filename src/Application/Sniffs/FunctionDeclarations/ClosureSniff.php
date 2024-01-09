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
 * Closures are available since PHP 5.3
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * $this in closure allowed since PHP 5.4
 * Anonymous functions may be declared statically since PHP 5.4
 * Anonymous functions allowed since PHP 5.3
 *
 * @link https://wiki.php.net/rfc/closures
 * @link https://wiki.php.net/rfc/closures/object-extension
 * @link https://www.php.net/manual/en/functions.anonymous.php
 * @link https://www.php.net/manual/en/functions.anonymous.php#functions.anonymous-functions.static
 *
 * @see tests/Sniffs/ClosureSniffTest
 */
final class ClosureSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5401';

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        $parent = $node->getAttribute($this->attributeParentKeyStore);

        if (!$parent instanceof Node\Expr\Closure) {
            // not in Closure context
            return null;
        }

        // Base minimum version 5.3.0 is already initialized by the "VersionResolverVisitor"

        if ($node instanceof Node\Expr\Variable && is_string($node->name)) {
            $keyword = $node->name;
        } elseif ($node instanceof Node\Expr\ClassConstFetch && $node->class instanceof Node\Name) {
            $keyword = (string) $node->class;
        } elseif ($node instanceof Node\Expr\StaticCall && $node->class instanceof Node\Name) {
            $keyword = (string) $node->class;
        } else {
            return null;
        }

        $name = strtolower($keyword);

        if (in_array($name, ['this', 'self', 'parent', 'static'])) {
            // Use of $this | self | parent | static inside a closure is allowed since PHP 5.4
            $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '5.4.0']);
            $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA54);
        }
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Use of this, self, parent or static keywords inside a closure is allowed since PHP 5.4.0',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-54',
        ];
    }
}
