<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Api\V5;

use Bartlett\CompatInfo\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\DataCollector\ErrorHandler;
use Bartlett\CompatInfo\PhpParser\NodeVisitor\NameResolverVisitor;
use Bartlett\CompatInfo\PhpParser\NodeVisitor\ParentContextVisitor;
use Bartlett\CompatInfo\PhpParser\NodeVisitor\VersionResolverVisitor;
use Bartlett\CompatInfo\Profiler\Profile;
use Bartlett\CompatInfo\Profiler\Profiler;
use Bartlett\Reflect\Event\AbstractDispatcher;
use Bartlett\Reflect\Event\CompleteEvent;
use Bartlett\Reflect\Event\ErrorEvent;
use Bartlett\Reflect\Event\ProgressEvent;
use Bartlett\Reflect\Event\SuccessEvent;

use PhpParser\Error;
use PhpParser\Lexer\Emulative;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\ParserFactory;

use Symfony\Component\Finder\Finder;

use Exception;

/**
 * @since Class available since Release 5.4.0
 */
class Parser extends AbstractDispatcher
{
    private $dataSourceId;
    private $analyser;
    private $references;

    public function __construct(
        NodeVisitor $analyser,
        ReferenceCollectionInterface $referenceCollection
    ) {
        $analyser->setParserSubject($this);
        $this->analyser = $analyser;
        $this->references = $referenceCollection;
    }

    /**
     * Set the data source identifier
     *
     * @param string $id Identifier to use for the data source
     *
     * @return self for fluent interface
     */
    public function setDataSourceId(string $id)
    {
        $this->dataSourceId = $id;
        return $this;
    }

    /**
     * Gets identifier of the current data source
     *
     * @return string
     */
    public function getDataSourceId()
    {
        return $this->dataSourceId;
    }

    /**
     * Analyse a data source and return all analyser metrics.
     *
     * @param PriorityQueue $queue
     * @param ErrorHandler $errorHandler
     * @param Profiler $profiler
     *
     * @return Profile
     * @throws Exception
     */
    public function parse(Finder $queue, ErrorHandler $errorHandler, Profiler $profiler)
    {
        $lexer = new Emulative(array(
            'usedAttributes' => array(
                'comments', 'startLine', 'endLine', 'startTokenPos', 'endTokenPos'
            )
        ));
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7, $lexer);
        $traverser = new NodeTraverser();
        $traverser->addVisitor(new ParentContextVisitor());
        $traverser->addVisitor(new NameResolverVisitor());

        $traverser->addVisitor(new VersionResolverVisitor($this->references));

        $traverser->addVisitor($this->analyser);

        $this->analyser->setUpBeforeVisitor();

        // analyse each file of the data source
        foreach($queue as $file) {
            $event = $this->dispatch(
                new ProgressEvent(
                    $this,
                    array(
                        'source'   => $this->dataSourceId,
                        'file'     => $file,
                    )
                )
            );

            $stmts = $parser->parse(
                file_get_contents($file->getPathname()),
                $errorHandler
            );
            if (empty($stmts)) {
                $errorHandler->handleError(
                    new Error('File has no contents', ['startLine' => 1])
                );
            }

            $this->analyser->setCurrentFile($file);
            $this->analyser->setErrorHandler($errorHandler);

            if ($errorHandler->hasErrors()) {
                foreach ($errorHandler->getErrors() as $e) {
                    $this->dispatch(
                        new ErrorEvent(
                            $this,
                            array(
                                'source' => $this->dataSourceId,
                                'file'   => $file,
                                'error'  => $e->getMessage()
                            )
                        )
                    );
                }
                $errorHandler->clearErrors();
                continue; // skip to next file of the data source
            }

            $this->analyser->setTokens($lexer->getTokens());

            $stmts = $traverser->traverse($stmts);

            $this->dispatch(
                new SuccessEvent(
                    $this,
                    array(
                        'source' => $this->dataSourceId,
                        'file'   => $file,
                        'ast'    => $stmts,
                    )
                )
            );
        }

        $this->analyser->tearDownAfterVisitor();

        // end of parsing the data source
        $this->dispatch(
            new CompleteEvent($this, array('source' => $this->dataSourceId))
        );

        return $profiler->collect();
    }
}
