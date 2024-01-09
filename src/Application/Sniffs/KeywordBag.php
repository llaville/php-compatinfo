<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bartlett\CompatInfo\Application\Sniffs;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use function array_key_exists;
use function array_merge;
use function substr_count;

/**
 * @phpstan-implements IteratorAggregate<string, string>
 * @author Laurent Laville
 */
final class KeywordBag implements IteratorAggregate, Countable
{
    /**
     * Keyword storage
     * @var array<string, string>
     */
    private array $keywords;

    /**
     * KeywordBag constructor.
     * @param array<string, string> $keywords
     */
    public function __construct(array $keywords = [])
    {
        $this->keywords = $keywords;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->keywords);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->keywords);
    }

    /**
     * @return array<string, string>
     */
    public function all(): array
    {
        return $this->keywords;
    }

    /**
     * @param array<string, string> $keywords
     */
    public function add(array $keywords = []): void
    {
        $this->keywords = array_merge($this->keywords, $keywords);
    }

    public function remove(string $word): bool
    {
        if ($this->has($word)) {
            unset($this->keywords[$word]);
            return true;
        }
        return false;
    }

    public function clear(): void
    {
        $this->keywords = [];
    }

    public function has(string $word): bool
    {
        return array_key_exists($word, $this->keywords);
    }

    public function get(string $word, string $default = '4.0.0'): string
    {
        if ($this->has($word)) {
            $version = $this->keywords[$word];

            if (substr_count($version, '.') < 2) {
                // version number in X.Y.Z format (bugfix part is always zero)
                $version .= '.0';
            }
            return $version;
        }
        return $default;
    }
}
