<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\PhpParser\Node\Name;

use PhpParser\Node\Name\FullyQualified;

/**
 * @author Laurent Laville
 * @since Release 5.4.0
 */
final class ClassFullyQualified extends FullyQualified
{
    public function getType(): string
    {
        return 'Name_ClassFullyQualified';
    }
}
