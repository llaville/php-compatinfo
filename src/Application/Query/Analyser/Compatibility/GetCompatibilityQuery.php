<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Query\Analyser\Compatibility;

use Bartlett\CompatInfo\Application\Query\QueryInterface;

/**
 * Value Object of console analyser:run command.
 *
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class GetCompatibilityQuery implements QueryInterface
{
    private string $source;
    /** @var string[] */
    private array $exclude;
    private bool $stopOnFailure;
    private string $version;

    /**
     * GetCompatibilityQuery class constructor.
     *
     * @param string $source
     * @param string[] $exclude
     * @param bool $stopOnFailure
     * @param string $version
     */
    public function __construct(string $source, array $exclude, bool $stopOnFailure, string $version)
    {
        $this->source = $source;
        $this->exclude = $exclude;
        $this->stopOnFailure = $stopOnFailure;
        $this->version = $version;
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

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}
