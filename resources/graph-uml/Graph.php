<?php declare(strict_types=1);

use Bartlett\GraphUml\Generator\GraphVizGenerator;
use Bartlett\UmlWriter\Generator\GeneratorFactory;
use Bartlett\UmlWriter\Service\ClassDiagramRenderer;

use Symfony\Component\Finder\Finder;

/**
 * @since Release 6.1.0
 * @author Laurent Laville
 */
final class Graph
{
    private Finder $finder;
    private ?string $folder;
    private string $basename;

    public function __construct(Finder $finder, string $basename, ?string $folder = null)
    {
        $this->finder = $finder;
        $this->folder = $folder;
        $this->basename = $basename;
    }

    public function __invoke(): void
    {
        $generatorFactory = new GeneratorFactory('graphviz');
        /** @var GraphVizGenerator $generator */
        $generator = $generatorFactory->getGenerator();

        $renderer = new ClassDiagramRenderer();
        $options = [
            'show_private' => false,
            'show_protected' => false,
            'node.fillcolor' => '#FEFECE',
            'node.style' => 'filled',
            'graph.rankdir' => 'LR',
            'cluster.Bartlett\\CompatInfo\\Application\\PhpParser\\NodeVisitor.graph.bgcolor' => 'lightblue',
        ];

        try {
            $renderer($this->finder, $generator, $options);
        } catch (ReflectionException $exception) {
            echo "Unable to generate graph. Following error has occurred : " . $exception->getMessage() . PHP_EOL;
            return;
        }

        // default format is PNG, change it to SVG
        $generator->setFormat('svg');

        if (isset($this->folder)) {
            $cmdFormat = '%E -T%F %t -o '
                . rtrim($this->folder, DIRECTORY_SEPARATOR) . '/' . $this->basename . '.graphviz.%F';
        } else {
            $cmdFormat = '';
        }
        $graph = $renderer->getGraph();
        $target = $generator->createImageFile($graph, $cmdFormat);
        echo (empty($target) ? 'no' : $target) . ' file generated' . PHP_EOL;
    }
}
