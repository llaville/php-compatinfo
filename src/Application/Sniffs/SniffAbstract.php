<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs;

use Bartlett\CompatInfo\Application\Analyser\SniffVisitorInterface;
use Bartlett\CompatInfo\Application\DataCollector\RuleUpdater;
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

use Generator;

/**
 * Base code for each sniff used to detect PHP features.
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 */
abstract class SniffAbstract extends NodeVisitorAbstract implements SniffInterface
{
    /** @var null|callable */
    protected $contextCallback;
    protected string $contextIdentifier;
    protected KeywordBag $forbiddenNames;
    protected SniffVisitorInterface $visitor;
    protected string $attributeParentKeyStore;
    protected string $attributeKeyStore;
    protected EventDispatcherInterface $dispatcher;

    use VersionUpdater;

    use RuleUpdater;

    public function __construct(EventDispatcherInterface $compatibilityEventDispatcher)
    {
        $this->dispatcher = $compatibilityEventDispatcher;
    }

    // NodeVisitorAbstract inheritance
    // public function beforeTraverse(array $nodes)    { }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        $this->dispatcher->dispatch(new BeforeProcessNodeEvent($this, ['node' => $node]));

        if (!empty($this->contextCallback) && is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function leaveNode(Node $node): int|Node|array|null
    {
        $this->dispatcher->dispatch(new AfterProcessNodeEvent($this, ['node' => $node]));
        return null;
    }

    // public function afterTraverse(array $nodes)     { }

    // SniffInterface implements

    public function setUpBeforeSniff(): void
    {
        $this->dispatcher->dispatch(new BeforeInitializeSniffEvent($this));
    }

    public function enterSniff(): void
    {
        $this->dispatcher->dispatch(new BeforeProcessSniffEvent($this));
    }

    public function leaveSniff(): void
    {
        $this->dispatcher->dispatch(new AfterProcessSniffEvent($this));
    }

    public function tearDownAfterSniff(): void
    {
        $this->dispatcher->dispatch(new AfterInitializeSniffEvent($this));
    }

    public function setVisitor(SniffVisitorInterface $visitor): void
    {
        $this->visitor = $visitor;
    }

    public function setAttributeParentKeyStore(string $key): void
    {
        $this->attributeParentKeyStore = $key;
    }

    public function setAttributeKeyStore(string $key): void
    {
        $this->attributeKeyStore = $key;
    }

    public function getRules(): Generator
    {
        // when sniff does not provide any rule
        yield from [];
    }

    protected function getNameContext(Node $node): string
    {
        if (!property_exists($node, 'name')) {
            return '';
        }
        return ($node->name instanceof Node\Name || $node->name instanceof Node\Identifier) ? (string) $node->name : '';
    }

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
        $this->updateNodeElementRule(
            $node,
            $this->attributeKeyStore,
            sprintf('CA%2d07', str_replace('.', '', $this->forbiddenNames->all()[$name]))
        );
    }
}
