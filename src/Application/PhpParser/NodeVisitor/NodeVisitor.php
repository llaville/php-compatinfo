<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\PhpParser\NodeVisitor;

use Doctrine\Common\Collections\Collection;

/**
 * @since Release 6.0.0
 */
interface NodeVisitor extends \PhpParser\NodeVisitor
{
    /**
     * @return Collection
     */
    public function getCollection(): Collection;
}
