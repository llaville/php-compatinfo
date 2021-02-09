<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Query\Analyser\Compatibility;

use Bartlett\CompatInfo\Application\Query\QueryInterface;

/**
 * @since Release 6.0.0
 */
final class GetCompatibilityQuery implements QueryInterface
{
    /** @var string  */
    private $source;
    /** @var string[] */
    private $exclude;
    /** @var bool  */
    private $stopOnFailure;

    /**
     * GetCompatibilityQuery class constructor.
     *
     * @param string $source
     * @param string[] $exclude
     * @param bool $stopOnFailure
     */
    public function __construct(string $source, array $exclude, bool $stopOnFailure)
    {
        $this->source = $source;
        $this->exclude = $exclude;
        $this->stopOnFailure = $stopOnFailure;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string[]
     */
    public function getExclude(): array
    {
        return $this->exclude;
    }

    /**
     * @return bool
     */
    public function isStopOnFailure(): bool
    {
        return $this->stopOnFailure;
    }
}
