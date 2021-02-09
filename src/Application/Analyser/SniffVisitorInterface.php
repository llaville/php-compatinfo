<?php declare(strict_types=1);

/**
 * Interface that all analysers using sniffs must implement.
 */

namespace Bartlett\CompatInfo\Application\Analyser;

/**
 * @since Release 6.0.0
 */
interface SniffVisitorInterface
{
    public function setUpBeforeVisitor(): void;
    public function tearDownAfterVisitor(): void;
}
