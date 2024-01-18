<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.1.0
 * @author Laurent Laville
 */

return function (): Generator
{
    $classes = [
        \Bartlett\CompatInfo\Application\PhpParser\Node\Name\ClassFullyQualified::class,
        \Bartlett\CompatInfo\Application\PhpParser\Node\Name\InterfaceFullyQualified::class,
        \Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\FilterVisitor::class,
        \Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\NameResolverVisitor::class,
        \Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\NodeVisitor::class,
        \Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\ParentContextVisitor::class,
        \Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\VersionResolverVisitor::class,
        \Bartlett\CompatInfo\Application\PhpParser\Parser::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
};
