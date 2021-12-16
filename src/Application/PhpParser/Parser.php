<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\PhpParser;

use Bartlett\CompatInfo\Application\Analyser\SniffAnalyserInterface;
use Bartlett\CompatInfo\Application\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;
use Bartlett\CompatInfo\Application\Event\AfterAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\AfterFileAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\BeforeAnalysisEvent;
use Bartlett\CompatInfo\Application\Event\BeforeFileAnalysisEvent;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\NameResolverVisitor;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\ParentContextVisitor;
use Bartlett\CompatInfo\Application\PhpParser\NodeVisitor\VersionResolverVisitor;
use Bartlett\CompatInfo\Application\Profiler\Profile;

use PhpParser\Error;
use PhpParser\Lexer;
use PhpParser\Lexer\Emulative;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use Exception;
use function file_get_contents;

/**
 * @since Release 5.4.0
 */
final class Parser
{
    /** @var EventDispatcherInterface  */
    private $dispatcher;
    /** @var SniffAnalyserInterface  */
    private $analyser;
    /** @var ReferenceCollectionInterface<string, array>  */
    private $references;
    /** @var ErrorHandler */
    private $errorHandler;
    /** @var \PhpParser\Parser */
    private $parser;
    /** @var Lexer */
    private $lexer;
    /** @var NodeTraverser */
    private $traverser;
    /** @var int */
    private $filesProceeded;

    /**
     * Parser constructor.
     *
     * @param EventDispatcherInterface $compatibilityEventDispatcher
     * @param SniffAnalyserInterface $compatibilityAnalyser
     * @param ReferenceCollectionInterface<string, array> $referenceCollection
     */
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
     * @return Profile
     * @throws Exception
     */
    public function parse(string $source, Finder $finder, ErrorHandler $errorHandler): Profile
    {
        $this->dispatcher->dispatch(new BeforeAnalysisEvent($this, ['source' => $source, 'queue' => $finder]));

        $this->filesProceeded = 0;

        $this->errorHandler = $errorHandler;

        $profiler = $this->analyser->getProfiler();

        $this->lexer = new Emulative([
                'usedAttributes' => [
                    'comments', 'startLine', 'endLine', 'startTokenPos', 'endTokenPos'
                ]
            ]);
        $this->parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7, $this->lexer);

        $this->traverser = new NodeTraverser();
        $this->traverser->addVisitor(new ParentContextVisitor());
        $this->traverser->addVisitor(new NameResolverVisitor($this->errorHandler));
        $this->traverser->addVisitor(new VersionResolverVisitor($this->references));
        $this->traverser->addVisitor($this->analyser);

        $this->analyser->setUpBeforeVisitor();

        foreach ($finder as $fileInfo) {
            $this->processFile($fileInfo);
        }

        $this->analyser->tearDownAfterVisitor();

        $profile = $profiler->collect();
        $this->dispatcher->dispatch(
            new AfterAnalysisEvent(
                $this,
                ['source' => $source, 'successCount' => $this->filesProceeded, 'profile' => $profile]
            )
        );

        return $profile;
    }

    /**
     * Procedure that analyse one file of the data source
     *
     * @param SplFileInfo $fileInfo
     */
    private function processFile(SplFileInfo $fileInfo): void
    {
        $this->dispatcher->dispatch(new BeforeFileAnalysisEvent($this, ['file' => $fileInfo]));

        $stmts = $this->parser->parse(
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
        $this->analyser->setTokens($this->lexer->getTokens());

        $this->traverser->traverse($stmts);

        $this->filesProceeded++;
        $this->dispatcher->dispatch(new AfterFileAnalysisEvent($this, ['file' => $fileInfo]));
    }
}
