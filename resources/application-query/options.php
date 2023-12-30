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
    'cluster.Bartlett\CompatInfo\Application\Query.graph.bgcolor' => 'BurlyWood',
    'cluster.Bartlett\CompatInfo\Application\Query\Analyser\Compatibility.graph.bgcolor' => 'Bisque',
    'cluster.Bartlett\CompatInfo\Application\Query\Diagnose.graph.bgcolor' => 'Bisque',
];
