<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface AfterTraverseAstInterface
{
    /**
     * Called once after AST traversal.
     *
     * @param AfterTraverseAstEvent<string, string> $event
     * @return void
     */
    public function afterTraverseAst(AfterTraverseAstEvent $event): void;
}
