<?php declare(strict_types=1);

/**
 * Base class to all sniffs.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Sniffs;

use Bartlett\CompatInfo\Analyser\AbstractAnalyser;
use Bartlett\CompatInfo\DataCollector\VersionUpdater;
use Bartlett\Reflect\Event\SniffEvent;
use Bartlett\Reflect\Visitor\VisitorInterface;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

use function get_class;

/**
 * Base code for each sniff used to detect PHP features.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.4.0
 */
abstract class SniffAbstract extends NodeVisitorAbstract implements SniffInterface
{
    /** @var callable */
    protected $contextCallback;

    /** @var string */
    protected $contextIdentifier;

    /** @var KeywordBag */
    protected $forbiddenNames;

    /** @var AbstractAnalyser */
    protected $visitor;

    /** @var string */
    protected $attributeParentKeyStore;

    /** @var string */
    protected $attributeKeyStore;

    use VersionUpdater;

    // NodeVisitorAbstract inheritance
    // public function beforeTraverse(array $nodes)    { }

    public function enterNode(Node $node)
    {
        if (!empty($this->contextCallback) && is_callable($this->contextCallback)) {
            call_user_func($this->contextCallback, $node);
        }

        return null;
    }

    // public function leaveNode(Node $node) { }
    // public function afterTraverse(array $nodes)     { }

    // SniffInterface implements

    /**
     * {@inheritDoc}
     */
    public function setUpBeforeSniff(): void
    {
        $this->visitor->getParserSubject()->dispatch(
            new SniffEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'sniff'  => get_class($this),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        $this->visitor->getParserSubject()->dispatch(
            new SniffEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'sniff'  => get_class($this),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function leaveSniff(): void
    {
        $this->visitor->getParserSubject()->dispatch(
            new SniffEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'sniff'  => get_class($this),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function tearDownAfterSniff(): void
    {
        $this->visitor->getParserSubject()->dispatch(
            new SniffEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'sniff'  => get_class($this),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function setVisitor(VisitorInterface $visitor): void
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
     * @return array
     *
     * @psalm-return array{file: false|string, line: mixed}
     */
    protected function getCurrentSpot(Node $node): array
    {
        return [
            'file'    => realpath($this->visitor->getCurrentFile()->getPathname()),
            'line'    => $node->getLine()
        ];
    }

    /**
     * @param string $version
     * @param string $operator
     * @param string $severity
     *
     * @return string
     */
    protected function getCurrentSeverity(string $version, string $operator = 'lt', string $severity = 'error'): string
    {
        if (version_compare(PHP_VERSION, $version, $operator)) {
            return 'warning';
        }
        return $severity;
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
