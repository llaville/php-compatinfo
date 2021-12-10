<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\PhpParser\Node\Name;

use PhpParser\Node\Name\FullyQualified;

class ClassFullyQualified extends FullyQualified
{
    public function getType(): string
    {
        return 'Name_ClassFullyQualified';
    }
}
