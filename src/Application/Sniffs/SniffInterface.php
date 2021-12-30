<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs;

use Bartlett\CompatInfo\Application\Analyser\SniffVisitorInterface;

use PhpParser\NodeVisitor;

use Generator;

/**
 * Interface that all sniffs must implement.
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 */
interface SniffInterface extends NodeVisitor
{
    // inherit NodeVisitor interface
    // ---
    // public function beforeTraverse(array $nodes);
    // public function enterNode(Node $node);
    // public function leaveNode(Node $node);
    // public function afterTraverse(array $nodes);

    public function setUpBeforeSniff(): void;
    public function enterSniff(): void;
    public function leaveSniff(): void;
    public function tearDownAfterSniff(): void;
    public function setVisitor(SniffVisitorInterface $visitor): void;
    public function setAttributeParentKeyStore(string $key): void;
    public function setAttributeKeyStore(string $key): void;
    /**
     * @return Generator<string, mixed>
     */
    public function getRules(): Generator;
}
