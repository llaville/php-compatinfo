<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Collection;

/**
 * @since Release 5.4.0
 */
interface ReferenceCollectionInterface
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
     * @return array
     */
    public function find(string $group, string $key, int $argc = 0, ?string $extra = null): array;
}
