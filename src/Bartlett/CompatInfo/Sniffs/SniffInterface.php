<?php declare(strict_types=1);

/**
 * Common interface to all sniffers.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Sniffs;

use Bartlett\Reflect\Visitor\VisitorInterface;

use PhpParser\NodeVisitor;

/**
 * Interface that all sniffs must implement.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.4.0
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
    public function setVisitor(VisitorInterface $visitor): void;
    public function setAttributeParentKeyStore(string $key): void;
    public function setAttributeKeyStore(string $key): void;
}
