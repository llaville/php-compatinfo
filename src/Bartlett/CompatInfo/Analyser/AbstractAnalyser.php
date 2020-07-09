<?php declare(strict_types=1);

/**
 * Base class to all analysers accessible through the AnalyserPlugin.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\CompatInfo\DataCollector\VersionUpdater;
use Bartlett\Reflect;
use Bartlett\Reflect\Event\BuildEvent;

use PhpParser\Node;
use PhpParser\NodeVisitor;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Provides common metrics for all analysers.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @since    Class available since Release 5.4.0
 */
abstract class AbstractAnalyser implements AnalyserInterface, NodeVisitor
{
    protected $namespaces = [];
    protected $testClass;
    protected $tokens;
    protected $file;
    protected $metrics = [];
    protected $subject;
    protected $contextStack;

    use VersionUpdater;

    /**
     * {@inheritDoc}
     */
    public function getSubject(): Reflect
    {
        return $this->subject;
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentFile(): SplFileInfo
    {
        return $this->file;
    }

    /**
     * {@inheritDoc}
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    /**
     * {@inheritDoc}
     */
    public function setSubject(Reflect $reflect): void
    {
        $this->subject = $reflect;
    }

    /**
     * {@inheritDoc}
     */
    public function setTokens(array $tokens): void
    {
        $this->tokens = $tokens;
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrentFile(SplFileInfo $file): void
    {
        $this->file = $file;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetrics(): array
    {
        return [get_class($this) => $this->metrics];
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        $parts = explode('\\', get_class($this));
        return array_pop($parts);
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace(): string
    {
        return implode('\\', array_slice(explode('\\', get_class($this)), 0, -1));
    }

    /**
     * {@inheritDoc}
     */
    public function getShortName(): string
    {
        return strtolower(str_replace('Analyser', '', $this->getName()));
    }

    /**
     * {@inheritDoc}
     */
    public function beforeTraverse(array $nodes)
    {
        $this->subject->dispatch(
            new BuildEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'analyser' => get_class($this),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        $this->subject->dispatch(
            new BuildEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => $node,
                    'analyser' => get_class($this),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        $this->subject->dispatch(
            new BuildEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => $node,
                    'analyser' => get_class($this),
                ]
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function afterTraverse(array $nodes)
    {
        $this->subject->dispatch(
            new BuildEvent(
                $this,
                [
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'analyser' => get_class($this),
                ]
            )
        );
    }
}
