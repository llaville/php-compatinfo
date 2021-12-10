<?php declare(strict_types=1);

/**
 * Base code for each sniff used to detect PHP features.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Application\Sniffs;

use Bartlett\CompatInfo\Application\Analyser\SniffVisitorInterface;
use Bartlett\CompatInfo\Application\DataCollector\VersionUpdater;
use Bartlett\CompatInfo\Application\Event\AfterInitializeSniffEvent;
use Bartlett\CompatInfo\Application\Event\AfterProcessNodeEvent;
use Bartlett\CompatInfo\Application\Event\AfterProcessSniffEvent;
use Bartlett\CompatInfo\Application\Event\BeforeInitializeSniffEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessNodeEvent;
use Bartlett\CompatInfo\Application\Event\BeforeProcessSniffEvent;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @since Release 5.4.0
 */
abstract class SniffAbstract extends NodeVisitorAbstract implements SniffInterface
{
    /** @var null|callable */
    protected $contextCallback;

    /** @var string */
    protected $contextIdentifier;

    /** @var KeywordBag */
    protected $forbiddenNames;

    /** @var SniffVisitorInterface */
    protected $visitor;

    /** @var string */
    protected $attributeParentKeyStore;

    /** @var string */
    protected $attributeKeyStore;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    use VersionUpdater;

    public function __construct(EventDispatcherInterface $compatibilityEventDispatcher)
    {
        $this->dispatcher = $compatibilityEventDispatcher;
    }

    // NodeVisitorAbstract inheritance
    // public function beforeTraverse(array $nodes)    { }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        $this->dispatcher->dispatch(new BeforeProcessNodeEvent($this, ['node' => $node]));

        if (!empty($this->contextCallback) && is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        $this->dispatcher->dispatch(new AfterProcessNodeEvent($this, ['node' => $node]));
        return null;
    }

    // public function afterTraverse(array $nodes)     { }

    // SniffInterface implements

    /**
     * {@inheritDoc}
     */
    public function setUpBeforeSniff(): void
    {
        $this->dispatcher->dispatch(new BeforeInitializeSniffEvent($this));
    }

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        $this->dispatcher->dispatch(new BeforeProcessSniffEvent($this));
    }

    /**
     * {@inheritDoc}
     */
    public function leaveSniff(): void
    {
        $this->dispatcher->dispatch(new AfterProcessSniffEvent($this));
    }

    /**
     * {@inheritDoc}
     */
    public function tearDownAfterSniff(): void
    {
        $this->dispatcher->dispatch(new AfterInitializeSniffEvent($this));
    }

    /**
     * {@inheritDoc}
     */
    public function setVisitor(SniffVisitorInterface $visitor): void
    {
        $this->visitor = $visitor;
    }

    /**
     * {@inheritDoc}
     */
    public function setAttributeParentKeyStore(string $key): void
    {
        $this->attributeParentKeyStore = $key;
    }

    /**
     * {@inheritDoc}
     */
    public function setAttributeKeyStore(string $key): void
    {
        $this->attributeKeyStore = $key;
    }

    /**
     * @param Node $node
     * @return string
     */
    protected function getNameContext(Node $node): string
    {
        if (!property_exists($node, 'name')) {
            return '';
        }
        return ($node->name instanceof Node\Name || $node->name instanceof Node\Identifier) ? (string) $node->name : '';
    }

    /**
     * @param Node $node
     * @param string $name
     * @return void
     */
    protected function checkForbiddenNames(Node $node, string $name): void
    {
        $name = strtolower($name);

        if (!$this->forbiddenNames->has($name)) {
            return;
        }

        $versions = [
            'php.max' => $this->forbiddenNames->get($name),
        ];

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, $versions);
    }
}
