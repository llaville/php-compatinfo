<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\PhpParser\Node\Name;

use PhpParser\Node\Name\FullyQualified;

/**
 * @since Release 5.4.0
 */
final class InterfaceFullyQualified extends FullyQualified
{
    public function getType(): string
    {
        return 'Name_InterfaceFullyQualified';
    }
}
