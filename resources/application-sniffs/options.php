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

return [
    'show_private' => false,
    'show_protected' => false,
    // @link https://graphviz.gitlab.io/docs/attrs/rankdir/
    'graph.rankdir' => 'LR',
    // @link https://plantuml.com/en/color
    'cluster.Bartlett\CompatInfo\Application\Sniffs.graph.bgcolor' => 'BurlyWood',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Arrays.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Classes.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Constants.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\ControlStructures.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Expressions.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\FunctionCalls.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Generators.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Keywords.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Numbers.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\Operators.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\TextProcessing.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Sniffs\UseDeclarations.graph.bgcolor' => 'Bisque',
];
