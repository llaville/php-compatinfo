<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Event;

/**
 * @since Release 6.0.0
 */
interface BeforeTraverseAstInterface
{
    /**
     * Called once before AST traversal.
     *
     * @param BeforeTraverseAstEvent<string, string> $event
     * @return void
     */
    public function beforeTraverseAst(BeforeTraverseAstEvent $event): void;
}
