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

        $color1 = 'burlywood3';     // Application layer
        $color2 = 'chartreuse3';    // Infrastructure layer
        $color3 = 'chocolate3';     // Presentation layer

        $renderer = new ClassDiagramRenderer();
        $options = [
            'show_private' => false,
            'show_protected' => false,
            'node.fillcolor' => '#FEFECE',
            'node.style' => 'filled',
            'graph.rankdir' => 'LR',
            'cluster.Bartlett\\CompatInfo\\Application\\Analyser.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Collection.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\DataCollector.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\DataCollector\\ErrorHandler.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\DataCollector\\Normalizer.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Event.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Event\\Dispatcher.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Extension.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Extension\\Reporter.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Logger.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\PhpParser.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\PhpParser\\Node.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\PhpParser\\Node\\Name.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\PhpParser\\NodeVisitor.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Profiler.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Query.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Query\\Analyser.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Query\\Analyser\\Compatibility.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Query\\Diagnose.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Service.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Arrays.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Classes.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Constants.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\ControlStructures.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Expression.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\FunctionDeclarations.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Generators.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Keywords.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Numbers.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\Operators.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\TextProcessing.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Application\\Sniffs\\UseDeclarations.graph.bgcolor' => $color1,
            'cluster.Bartlett\\CompatInfo\\Infrastructure\\Bus\\Query.graph.bgcolor' => $color2,
            'cluster.Bartlett\\CompatInfo\\Infrastructure\\Framework\\Symfony.graph.bgcolor' => $color2,
            'cluster.Bartlett\\CompatInfo\\Infrastructure\\Framework\\Symfony\\DependencyInjection.graph.bgcolor' => $color2,
            'cluster.Bartlett\\CompatInfo\\Presentation\\Console.graph.bgcolor' => $color3,
            'cluster.Bartlett\\CompatInfo\\Presentation\\Console\\Command.graph.bgcolor' => $color3,
            'cluster.Bartlett\\CompatInfo\\Presentation\\Console\\Input.graph.bgcolor' => $color3,
            'cluster.Bartlett\\CompatInfo\\Presentation\\Console\\Output.graph.bgcolor' => $color3,
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

    /**
     * @param string[] $paths
     */
    public static function from(string $dataSource, array $paths, string $basename, ?string $target)
    {
        foreach ($paths as $path) {
            $finder = new Finder();
            $finder->in($dataSource . '/' . $path)->name('*.php');
            $self = new self($finder, $basename . '_' . strtolower($path), $target);
            $self();
        }
    }
}
