<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\PhpParser;

use Bartlett\CompatInfo\Application\Analyser\SniffAnalyserInterface;
use Bartlett\CompatInfo\Application\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;
use Bartlett\CompatInfo\Application\Event\ProgressEvent;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\NameResolverVisitor;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\ParentContextVisitor;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\VersionResolverVisitor;

use PhpParser\Error;
use PhpParser\Lexer\Emulative;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use function file_get_contents;

/**
 * @since Release 5.4.0
 */
class Parser
{
    private $dispatcher;
    private $analyser;
    private $references;
    private $errorHandler;

    public function __construct(
        EventDispatcherInterface $compatibilityEventDispatcher,
        SniffAnalyserInterface $compatibilityAnalyser,
        ReferenceCollectionInterface $referenceCollection
    ) {
        $this->dispatcher = $compatibilityEventDispatcher;
        $this->analyser = $compatibilityAnalyser;
        $this->references = $referenceCollection;
    }

    /**
     * Analyse a data source and return all analyser metrics.
     *
     * @param string $source
     * @param Finder $finder
     * @param ErrorHandler $errorHandler
     *
     */
    public function parse(string $source, Finder $finder, ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;

        $profiler = $this->analyser->getProfiler();
        $profiler->reset();

        $this->analyser->setUpBeforeVisitor();

        if ($this->dispatcher->hasListeners(ProgressEvent::class)) {
            $this->dispatcher->dispatch(
                new ProgressEvent(
                    $this,
                    [
                        'source'  => $source,
                        'queue'   => $finder,
                        'closure' => [$this, 'processFile']
                    ]
                )
            );
        } else {
            foreach ($finder as $fileInfo) {
                $this->processFile($fileInfo);
            }
        }

        $this->analyser->tearDownAfterVisitor();

        return $profiler->collect();
    }

    /**
     * Callback that analyse one file of the data source
     *
     * @param SplFileInfo $fileInfo
     */
    public function processFile(SplFileInfo $fileInfo)
    {
        static $lexer;
        static $parser;
        static $traverser;

        if (!$parser) {
            $lexer = new Emulative([
                'usedAttributes' => [
                    'comments', 'startLine', 'endLine', 'startTokenPos', 'endTokenPos'
                ]
            ]);
            $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7, $lexer);

            $traverser = new NodeTraverser();
            $traverser->addVisitor(new ParentContextVisitor());
            $traverser->addVisitor(new NameResolverVisitor($this->errorHandler));
            $traverser->addVisitor(new VersionResolverVisitor($this->references));
            $traverser->addVisitor($this->analyser);
        }

        $stmts = $parser->parse(
            file_get_contents($fileInfo->getPathname()),
            $this->errorHandler
        );
        if (empty($stmts)) {
            $this->errorHandler->handleError(
                new Error('File has no contents', ['startLine' => 1])
            );
        }

        $this->analyser->setCurrentFile($fileInfo);
        $this->analyser->setErrorHandler($this->errorHandler);
        $this->analyser->setTokens($lexer->getTokens());

        $traverser->traverse($stmts);
    }
}
