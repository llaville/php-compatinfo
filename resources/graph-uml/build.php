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

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Bartlett\GraphUml\ClassDiagramBuilder;
use Bartlett\GraphUml\Generator\GraphVizGenerator;

use Graphp\Graph\Graph;
use Graphp\GraphViz\GraphViz;

$script = $_SERVER['argv'][1] ?? null;

if (!$script) {
    throw new LogicException("Unable to build a graph UML for unknown script.");
}
$script = basename($script, '.php');

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'datasource', $script])  . '.php';
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'filter', $script])  . '.php';
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'callback', $script])  . '.php';
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'options', $script])  . '.php';

$generator = new GraphVizGenerator(new GraphViz());
$graph = new Graph();
$builder = new ClassDiagramBuilder($generator, $graph, $options);

try {
    $builder->createVerticesFromCallable($callback, dataSource());
} catch (Exception $e) {
    echo 'Unable to build graph UML : ' . $e->getMessage() . PHP_EOL;
    die();
}

// For large graph, orientation is recommended
// https://graphviz.gitlab.io/docs/attrs/rankdir/
$graph->setAttribute($generator->getPrefix() . 'graph.rankdir', $options['graph.rankdir'] ?? 'LR');
// https://graphviz.gitlab.io/docs/attrs/bgcolor/
$graph->setAttribute($generator->getPrefix() . 'graph.bgcolor', $options['graph.bgcolor'] ?? 'transparent');
// https://graphviz.gitlab.io/docs/attrs/fillcolor/
$graph->setAttribute($generator->getPrefix() . 'node.fillcolor', $options['node.fillcolor'] ?? '#FEFECE');
// https://graphviz.gitlab.io/docs/attrs/style/
$graph->setAttribute($generator->getPrefix() . 'node.style', $options['node.style'] ?? 'filled');

// writes graphviz statements to file
$folder = $_SERVER['argv'][2] ?? null;
$format = sprintf('.%s.gv', $options['label_format']);
$output = rtrim($folder, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $script . $format;
file_put_contents($output, $generator->createScript($graph));

// default format is PNG, change it to SVG
$generator->setFormat($format = 'svg');

if (isset($folder)) {
    $output = rtrim($folder, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $script . '.graphviz.' . $format;
    $cmdFormat = '%E -T%F %t -o ' . $output;
} else {
    $cmdFormat = '';
}
$target = $generator->createImageFile($graph, $cmdFormat);
echo (empty($target) ? 'no' : $target) . ' file generated' . PHP_EOL;
