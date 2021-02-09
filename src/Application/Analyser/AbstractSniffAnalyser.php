<?php declare(strict_types=1);

/**
 * Base code for all analysers that used sniffs.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

namespace Bartlett\CompatInfo\Application\Analyser;

use Bartlett\CompatInfo\Application\Collection\SniffCollection;
use Bartlett\CompatInfo\Application\Collection\SniffCollectionInterface;
use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;
use Bartlett\CompatInfo\Application\Event\AfterProcessNodeEvent;
use Bartlett\CompatInfo\Application\Event\AfterTraverseAstEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessNodeEvent;
use Bartlett\CompatInfo\Application\Event\BeforeTraverseAstEvent;
use Bartlett\CompatInfo\Application\Profiler\ProfilerInterface;
use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;

use PhpParser\Node;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @since Release 5.4.0
 */
abstract class AbstractSniffAnalyser implements SniffAnalyserInterface
{
    /** @var EventDispatcherInterface  */
    private $dispatcher;
    /** @var SniffCollectionInterface<SniffInterface>  */
    private $sniffs;
    /** @var string  */
    private $attributeParentKey;
    /** @var string  */
    private $attributeKey;

    /** @var ProfilerInterface  */
    protected $profiler;

    /**
     * @param ProfilerInterface $profiler
     * @param EventDispatcherInterface $dispatcher
     * @param SniffCollectionInterface<SniffInterface> $sniffs
     * @param string $attributeParentKey
     * @param string $attributeKey
     */
    public function __construct(
        ProfilerInterface $profiler,
        EventDispatcherInterface $dispatcher,
        SniffCollectionInterface $sniffs,
        string $attributeParentKey,
        string $attributeKey
    ) {
        $this->profiler = $profiler;
        $this->dispatcher = $dispatcher;
        $this->sniffs = $sniffs;
        $this->attributeParentKey = $attributeParentKey;
        $this->attributeKey = $attributeKey;
    }

    /**
     * {@inheritDoc}
     */
    public function getProfiler(): ProfilerInterface
    {
        return $this->profiler;
    }

    /**
     * {@inheritDoc}
     */
    public function setErrorHandler(ErrorHandler $errorHandler): void
    {
        foreach ($this->profiler->getCollectors() as $collector) {
            $collector->addFile($this->getCurrentFile());
            $collector->addErrors($errorHandler->getErrors());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setUpBeforeVisitor(): void
    {
        foreach ($this->sniffs as $sniff) {
            $sniff->setVisitor($this);
            $sniff->setAttributeParentKeyStore($this->attributeParentKey);
            $sniff->setAttributeKeyStore($this->attributeKey);
            $sniff->setUpBeforeSniff();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function tearDownAfterVisitor(): void
    {
        foreach ($this->sniffs as $sniff) {
            $sniff->tearDownAfterSniff();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function beforeTraverse(array $nodes): ?array
    {
        $this->dispatcher->dispatch(new BeforeTraverseAstEvent($this, ['nodes' => $nodes]));

        foreach ($this->sniffs as $sniff) {
            $sniff->enterSniff();
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        $this->dispatcher->dispatch(new BeforeProcessNodeEvent($this, ['node' => $node]));

        foreach ($this->sniffs as $sniff) {
            $sniff->enterNode($node);
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        foreach ($this->sniffs as $sniff) {
            $sniff->leaveNode($node);
        }

        $this->dispatcher->dispatch(new AfterProcessNodeEvent($this, ['node' => $node]));
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function afterTraverse(array $nodes): ?array
    {
        $this->dispatcher->dispatch(new AfterTraverseAstEvent($this, ['nodes' => $nodes]));

        foreach ($this->sniffs as $sniff) {
            $sniff->leaveSniff();
        }
        return null;
    }
}