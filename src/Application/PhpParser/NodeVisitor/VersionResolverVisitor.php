<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\PhpParser\NodeVisitor;

use Bartlett\CompatInfo\Application\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\Application\DataCollector\VersionUpdater;
use Bartlett\CompatInfo\Application\PhpParser\Node\Name\ClassFullyQualified;
use Bartlett\CompatInfo\Application\PhpParser\Node\Name\EnumFullyQualified;
use Bartlett\CompatInfo\Application\PhpParser\Node\Name\InterfaceFullyQualified;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

/**
 * @author Laurent Laville
 */
final class VersionResolverVisitor extends NodeVisitorAbstract
{
    private string $attributeKey;
    private string $attributeNamespacedName;
    /** @var ReferenceCollectionInterface<string, array> */
    private ReferenceCollectionInterface $references;

    use VersionUpdater;

    /**
     * Constructs a version resolution visitor.
     *
     * Options:
     *  * nodeAttributeKeyStore (default "bartlett.compatibility_analyser"): An attribute will be added
     *    on each namespaces, classes, interfaces, traits, enumerations, methods, functions, closures or arrow functions
     *    to store the minimum version required.
     *
     * @param ReferenceCollectionInterface<string, array> $referenceCollection
     * @param array<string, string> $options
     */
    public function __construct(ReferenceCollectionInterface $referenceCollection, array $options = [])
    {
        $this->references = $referenceCollection;
        $this->attributeKey = $options['nodeAttributeKeyStore'] ?? 'bartlett.data_collector';
        $this->attributeNamespacedName = $options['nodeAttributeNamespacedName'] ?? 'bartlett.name';
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node)
    {
        $currentVersions = self::$php4;

        if ($node instanceof Node\Stmt\Namespace_) {
            if (null === $node->name) {
                $currentVersions['ext.name'] = 'core';
            } else {
                $currentVersions['php.min'] = '5.3.0';
            }
        } elseif ($node instanceof Node\Stmt\Class_) {
            if (null !== $node->extends) {
                $versions = $this->resolveClassVersions($node->extends, 'classes');
                $this->updateElementVersion($currentVersions, $versions);
            }

            foreach ($node->implements as $interface) {
                $versions = $this->resolveClassVersions($interface, 'interfaces');
                $this->updateElementVersion($currentVersions, $versions);
                // identify interface for FilterVisitor
                $interface->setAttribute($this->attributeNamespacedName, $interface);
                $this->updateNodeElementVersion($interface, $this->attributeKey, $versions);
            }
        } elseif ($node instanceof Node\Stmt\Interface_) {
            foreach ($node->extends as $interface) {
                $versions = $this->resolveClassVersions($interface, 'interfaces');
                $this->updateElementVersion($currentVersions, $versions);
            }
        } elseif ($node instanceof Node\Stmt\Trait_) {
            $currentVersions['php.min'] = '5.4.0';
        } elseif ($node instanceof Node\FunctionLike) {
            if ($node instanceof Node\Expr\ArrowFunction) {
                // @link https://www.php.net/manual/en/functions.arrow.php
                $currentVersions['php.min'] = '7.4.0';
            } elseif ($node instanceof Node\Expr\Closure) {
                $currentVersions['php.min'] = '5.3.0';
            } elseif ($node instanceof Node\Stmt\Function_) {
                if ($node->namespacedName->isQualified()) {
                    $currentVersions['php.min'] = '5.3.0';
                } else {
                    $currentVersions['php.min'] = '4.0.0';
                }
            }

            $currentVersions = $this->handleParameters($node, $currentVersions);
        } else {
            // do nothing on other nodes
            return null;
        }

        $currentVersions['declared'] = true;
        $node->setAttribute($this->attributeKey, $currentVersions);

        return null;
    }

    /**
     * Handles all arguments of function like.
     *
     * @param array<string, string> $currentVersions
     * @return array<string, string>
     */
    private function handleParameters(Node\FunctionLike $node, array $currentVersions): array
    {
        foreach ($node->getParams() as $param) {
            if ($param->type instanceof Node\IntersectionType) {
                $this->updateElementVersion($currentVersions, ['php.min' => '8.1.0']);
                continue;
            }
            if ($param->type instanceof Node\UnionType) {
                $this->updateElementVersion($currentVersions, ['php.min' => '8.0.0']);
                continue;
            }

            if (null !== $param->type) {
                $group = $this->resolveTypeVersions($param->type);
                $attributes = $param->type->getAttributes();

                if ($param->type instanceof Node\NullableType) {
                    $name = (string) $param->type->type;
                } else {
                    $name = (string) $param->type;
                }

                if ('interfaces' === $group) {
                    $newType = new InterfaceFullyQualified($name, $attributes);
                } elseif ('enumerations' === $group) {
                    $newType = new EnumFullyQualified($name, $attributes);
                } else {
                    $newType = new ClassFullyQualified($name, $attributes);
                }
                $param->type = $param->type instanceof Node\NullableType
                    ? new Node\NullableType((string) $newType)
                    : $newType
                ;

                $this->updateElementVersion($currentVersions, $attributes[$this->attributeKey]);
            }
        }

        return $currentVersions;
    }

    /**
     * Checks for extension's class or interface in database if referenced.
     *
     * @return array<string, string>
     */
    private function resolveClassVersions(Node\Name $name, string $group): array
    {
        // not yet known, try to detect for non user elements
        $versions = $this->references->find($group, (string) $name);
        // arg.max is useless (nonsense) in this context
        unset($versions['arg.max']);

        if ('user' == $versions['ext.name']) {
            if ('interfaces' === $group) {
                $min = $name->isQualified() ? '5.3.0' : '5.0.0';
                $this->updateVersion($min, $versions['php.min']);
            } else {
                if ($name->isUnqualified()) {
                    // PHP4 syntax (global namespace)
                    $min = '4.0.0';
                    $this->updateVersion($min, $versions['php.min']);
                }
            }
        }
        return $versions;
    }

    /**
     * Checks for extension's class or interface, used as type hinting, if referenced in database.
     */
    private function resolveTypeVersions(Node $node): string
    {
        $groups = ['enumerations', 'interfaces', 'classes'];
        $name = $node instanceof Node\NullableType ? $node->type : $node;

        if ($name instanceof Node\Name || $name instanceof Node\Identifier) {
            $name = (string) $name;
        }

        if (!is_string($name)) {
            // Node undetected, returns default
            return 'classes';
        }

        foreach ($groups as $group) {
            // not yet known, try to detect for non-user elements
            $versions = $this->references->find($group, $name);
            // arg.max is useless (nonsense) in this context
            unset($versions['arg.max']);

            if ('user' !== $versions['ext.name']) {
                break;
            }
            // remove the previously cached response before trying new attempt
            $this->references->remove($name);
        }

        $node->setAttribute($this->attributeKey, $versions);

        return $group;
    }
}
