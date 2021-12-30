<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Collection;

use Doctrine\Common\Collections\Collection;

/**
 * @template-extends Collection<string, array>
 * @author Laurent Laville
 * @since Release 5.4.0
 */
interface ReferenceCollectionInterface extends Collection
{
    /**
     * Fetch the database to retrieve, when possible, element informations.
     *
     * @param string $group May be either 'classes', 'methods', 'functions',
     *                       'constants', 'traits', 'interfaces'
     * @param string $key Name of element to search for
     * @param int $argc Number of arguments used in current element signature
     * @param string|null $extra Name of class when searching for methods
     *
     * @return string[]
     */
    public function find(string $group, string $key, int $argc = 0, ?string $extra = null): array;
}
