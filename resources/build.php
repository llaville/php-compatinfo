<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 7.1.0
 * @author Laurent Laville
 */

use Bartlett\GraphUml\Generator\GraphVizGenerator;
use Bartlett\UmlWriter\Generator\GeneratorFactory;
use Bartlett\UmlWriter\Service\ClassDiagramRenderer;

use Clue\GraphComposer\Command\Export;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

require_once dirname(__DIR__) . '/config/bootstrap.php';
require_once dirname(__DIR__) . '/vendor-bin/umlwriter/vendor/autoload.php';

$script = $_SERVER['argv'][1] ?? null;
$folder = $_SERVER['argv'][2] ?? sys_get_temp_dir();
$format = $_SERVER['argv'][3] ?? 'svg';

$graphComposer = 'phar://' . __DIR__ . '/graph-composer.phar';
if ('graph-composer' == $script) {
    if (!file_exists($graphComposer)) {
        exit(1);
    }
    require_once $graphComposer . '/vendor/autoload.php';

    $export = new Export('export');
    $target = $folder . '/graph-composer.svg';
    $input = new ArrayInput([
        'dir' => dirname(__DIR__),
        'output' => $target,
        '--depth' => 2,
        '--orientation' => 'LR',
    ]);
    $status = $export->run($input, new NullOutput());
    echo ($status != 0 ? 'no' : $target) . ' file generated' . PHP_EOL;
    exit($status);
}

$baseDir = __DIR__ . DIRECTORY_SEPARATOR . $script . DIRECTORY_SEPARATOR;
$available = is_dir($baseDir) && file_exists($baseDir);

if (empty($script) || !$available) {
    throw new LogicException(sprintf('Unable to build a graph for unknown script "%s"', $script));
}

$resources = [
    $baseDir . '/datasource.php',
    $baseDir . '/options.php',
];

foreach ($resources as $resource) {
    if (file_exists($resource)) {
        $variable = basename($resource, '.php');
        $$variable = require $resource;
    }
}

$generatorFactory = new GeneratorFactory();
/** @var GraphVizGenerator $generator */
$generator = $generatorFactory->createInstance('graphviz', $format);

$renderer = new ClassDiagramRenderer();
// generates UML class diagram of all objects found in dataSource (in graphviz format)
$graph = $renderer($datasource(), $generator, $options ?? []);

// writes graph statements to file
$output = rtrim($folder, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $script . '_archi.html.gv';
file_put_contents($output, $generator->createScript($graph));

$output = rtrim($folder, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $script . '_archi.graphviz.' . $format;
$cmdFormat = '%E -T%F %t -o ' . $output;
$target = $generator->createImageFile($graph, $cmdFormat);
echo (empty($target) ? 'no' : $target) . ' file generated' . PHP_EOL;
