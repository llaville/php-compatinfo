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

use PhpParser\Node;

/**
 * @since Release 5.4.0
 */
abstract class AbstractSniffAnalyser implements SniffAnalyserInterface
{
    private $sniffs;
    private $attributeParentKey;
    private $attributeKey;

    public function __construct(SniffCollection $sniffs, string $attributeParentKey, string $attributeKey)
    {
        $this->sniffs = $sniffs;
        $this->attributeParentKey = $attributeParentKey;
        $this->attributeKey = $attributeKey;
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
    public function beforeTraverse(array $nodes)
    {
        foreach ($this->sniffs as $sniff) {
            $sniff->enterSniff();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        foreach ($this->sniffs as $sniff) {
            $sniff->enterNode($node);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        foreach ($this->sniffs as $sniff) {
            $sniff->leaveNode($node);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function afterTraverse(array $nodes)
    {
        foreach ($this->sniffs as $sniff) {
            $sniff->leaveSniff();
        }
    }
}
