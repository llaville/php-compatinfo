<?php declare(strict_types=1);

/**
 * Base class to all analysers accessible through the AnalyserPlugin
 * that used sniff.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\Reflect\Event\SniffEvent;
use Bartlett\Reflect\Visitor\VisitorInterface;

use PhpParser\Node;

/**
 * Base code for all analysers that used sniffs.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @since    Class available since Release 5.4.0
 */
abstract class AbstractSniffAnalyser extends AbstractAnalyser implements VisitorInterface
{
    protected $contextCallback;
    protected $contextIdentifier;
    protected $sniffs;
    protected $subject;

    private $attributeParentKey;
    private $attributeKey;

    public function __construct(string $attributeParentKey, string $attributeKey)
    {
        $this->attributeParentKey = $attributeParentKey;
        $this->attributeKey = $attributeKey;
    }

    public function getParserSubject()
    {
        return $this->subject;
    }

    public function setParserSubject($parser): void
    {
        $this->subject = $parser;
    }

    /**
     * {@inheritDoc}
     */
    public function setUpBeforeVisitor(): void
    {
        $this->subject->dispatch(
            new SniffEvent(
                $this,
                array(
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'analyser' => get_class($this),
                )
            )
        );

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
        $this->subject->dispatch(
            new SniffEvent(
                $this,
                array(
                    'method' => __FUNCTION__,
                    'node'   => null,
                    'analyser' => get_class($this),
                )
            )
        );

        foreach ($this->sniffs as $sniff) {
            $sniff->tearDownAfterSniff();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function beforeTraverse(array $nodes)
    {
        parent::beforeTraverse($nodes);

        foreach ($this->sniffs as $sniff) {
            $sniff->enterSniff();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        foreach ($this->sniffs as $sniff) {
            $sniff->enterNode($node);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        parent::leaveNode($node);

        foreach ($this->sniffs as $sniff) {
            $sniff->leaveNode($node);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function afterTraverse(array $nodes)
    {
        parent::afterTraverse($nodes);

        foreach ($this->sniffs as $sniff) {
            $sniff->leaveSniff();
        }
    }

    /**
     * @param Node|string $node
     * @return string
     */
    protected function getNameContext($node): string
    {
        return (is_string($node) || $node instanceof Node\Name || $node instanceof Node\Identifier)
            ? (string) $node
            : ''
            ;
    }
}
